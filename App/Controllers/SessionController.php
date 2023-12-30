<?php

namespace App\Controllers;

class SessionController
{
    public function check(): bool
    {
        if (session_status() === PHP_SESSION_DISABLED) {
            return false;
        }

        session_start();

        return true;
    }

    public function manager(string $username): bool
    {
        if (!$this->check()) return false;

        $_SESSION['manager'] = $username;

        return true;
    }

    public function checkManagerSession(): bool
    {
        if (!$this->check()) return false;

        if (!isset($_SESSION['manager'])) {
            return false;
        }
        return true;
    }

    public function deleteManagerSession(): bool
    {
        if (! $this->check()) return false;

        unset($_SESSION['manager']);

        return true;
    }

    public function author(string $username): bool
    {
        if (!$this->check()) return false;

        $_SESSION['author'] = $username;

        return true;
    }

    public function deleteAuthorSession(): bool
    {
        if (! $this->check()) return false;

        unset($_SESSION['author']);

        return true;
    }

    public function checkAuthorSession(): bool
    {
        if (!$this->check()) return false;

        if (!isset($_SESSION['author'])) {
            return false;
        }
        return true;
    }

    public function checkModeratorsSession(): bool
    {
        if (!$this->check()) return false;

        if (!isset($_SESSION['moderator'])) {
            return false;
        }
        return true;
    }

    public function moderator(string $username): bool
    {
        if (!$this->check()) return false;

        $_SESSION['moderator'] = $username;

        return true;
    }

    public function deleteModeratorSession(): bool
    {
        if (! $this->check()) return false;

        unset($_SESSION['moderator']);

        return true;
    }
}