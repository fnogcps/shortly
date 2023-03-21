<?php

declare(strict_types=1);

namespace fnogcps\Shortly\Controllers;

use fnogcps\Shortly\Models\Link;
use Throwable;

final class LinkController
{
    private object $model;
    public function __construct(Link $model = new Link())
    {
        $this->model = $model;
    }

    public function createLink(string $url): string
    {
        try {
            // generate sha1
            $hash = sha1($url);
            // shuffle str + random int
            $sub = substr($hash, 0, 8);
            // get first 8 characters
            $code = str_shuffle($sub) . mt_rand(1, 99);
            return $this->model->create($url, $code);
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function getLink(string $code): void
    {
        try {
            $target = $this->model->get($code);
            header("Location: ${target}");
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}
