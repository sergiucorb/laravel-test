<?php

namespace App\Repositories;

use App\Contracts\SearchableContract;
use App\Models\Post;

class EloquentPostSearchRepository extends DatabasePostSearchRepository implements SearchableContract
{
    protected $query;

    public function __construct()
    {
        parent::__construct();
        $this->query = Post::select('*');
    }

}
