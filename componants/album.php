<?php

require_once './db/connexion.php';

class Album
{
    public int $id;
    public string $name;
    public int $NumberView;
    public int $NumberLike;
    public bool $isPublic;

    public function __construct($album)
    {
        $this->id = $album['id'];
        $this->name = $album['name'];
        $this->NumberView = $album['NumberView'];
        $this->NumberLike = $album['NumberLike'];
        $this->isPublic = $album['isPublic'];
    }

    public function likeMovie($Movieid)
    {

    }
}
?>