<?php

require_once './db/connexion.php';

class User
{
    public string $pseudo;
    public string $email;
    public string $password;
    public string $pdp;

    public function __construct($user)
    {
        $this->pseudo = $user['pseudo'];
        $this->email = $user['email'];
        $this->PasswordHash($user['password']);
        $this->pdp = $user['pdp'];
    }

    public function PasswordHash($pass): bool
    {
        $this->password = password_hash($pass, PASSWORD_DEFAULT);
        return true;
    }

    public function MailValid($email1, $email2): string
    {
        if ($email1 == $email2) {
            $this->email = $email1;
            return true;
        }
        else {
            return 'Les Adresses Emails ne sont pas les mêmes !';
        }
    }

    public function register(): bool
    {
        echo 'test';
        $query = $this->DBB->prepare('INSERT INTO utilisateur (pseudo, email, password, pdp) VALUES (:pseudo, :email, :password, :pdp)');
        return $query->execute([
            'pseudo' => htmlspecialchars($this->pseudo),
            'email' => htmlspecialchars($this->email),
            'password' => htmlspecialchars($this->password),
            'pdp' => htmlspecialchars($this->pdp)
        ]);
    }
}

?>