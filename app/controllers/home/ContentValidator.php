<?php


namespace controllers\home;


class ContentValidator
{
    public function emailContent($email)
    {
        if (!isset($email)) {
            throw new \Exception("We need an email to published your comment");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("This is not a valid email adresse");
        }
        return htmlspecialchars($email);
    }

    public function commentsContent($comments)
    {
        if (!isset($comments)) {
            throw new \Exception("No comments");
        }
        if (!is_string($comments)) {
            throw new \Exception("This is no a valid comment");
        }
        if (strlen($comments) > 255) {
            throw new \Exception("Your comments must be less than 255 caracteres");
        }
        return htmlspecialchars($comments);
    }
}