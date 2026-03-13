<?php
/* SimpleSMTP – send HTML email via SMTP (works with Gmail, Outlook, or any SMTP provider) */

class SimpleSMTP
{
    private $host;
    private $port;
    private $user;
    private $pass;
    private $from;
    private $fromName;

    public function __construct($host, $port, $user, $pass, $from, $fromName = '')
    {
        $this->host     = $host;
        $this->port     = (int) $port;
        $this->user     = $user;
        $this->pass     = $pass;
        $this->from     = $from;
        $this->fromName = $fromName ?: $from;
    }

    public function send($to, $subject, $htmlBody)
    {
        $ctx = stream_context_create([
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ],
        ]);

        // SSL (port 465) vs plain/STARTTLS (port 587 / 25)
        if ($this->port === 465) {
            $sock = stream_socket_client(
                "ssl://{$this->host}:{$this->port}",
                $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $ctx
            );
        } else {
            $sock = stream_socket_client(
                "tcp://{$this->host}:{$this->port}",
                $errno, $errstr, 30
            );
        }

        if (!$sock) {
            throw new RuntimeException("SMTP connect failed: $errstr ($errno)");
        }

        stream_set_timeout($sock, 30);

        $this->expect($sock);                              // greeting
        $this->cmd($sock, "EHLO localhost");

        if ($this->port === 587) {
            $this->cmd($sock, "STARTTLS");
            stream_socket_enable_crypto($sock, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            $this->cmd($sock, "EHLO localhost");
        }

        $this->cmd($sock, "AUTH LOGIN");
        $this->cmd($sock, base64_encode($this->user));
        $this->cmd($sock, base64_encode($this->pass));
        $this->cmd($sock, "MAIL FROM:<{$this->from}>");
        $this->cmd($sock, "RCPT TO:<{$to}>");
        $this->cmd($sock, "DATA");

        $msg  = "From: =?UTF-8?B?" . base64_encode($this->fromName) . "?= <{$this->from}>\r\n";
        $msg .= "To: {$to}\r\n";
        $msg .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
        $msg .= "MIME-Version: 1.0\r\n";
        $msg .= "Content-Type: text/html; charset=UTF-8\r\n";
        $msg .= "Date: " . date('r') . "\r\n";
        $msg .= "\r\n";
        $msg .= $htmlBody;
        $msg .= "\r\n.";

        fwrite($sock, $msg . "\r\n");
        $this->expect($sock);

        $this->cmd($sock, "QUIT");
        fclose($sock);
        return true;
    }

    private function cmd($sock, $line)
    {
        fwrite($sock, $line . "\r\n");
        return $this->expect($sock);
    }

    private function expect($sock)
    {
        $resp = '';
        while ($line = fgets($sock, 512)) {
            $resp .= $line;
            if ($line[3] === ' ') break;   // last line of multi-line response
        }
        $code = (int) substr($resp, 0, 3);
        if ($code >= 400) {
            throw new RuntimeException("SMTP error: " . trim($resp));
        }
        return $resp;
    }
}
