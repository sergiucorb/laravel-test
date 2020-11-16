<?php

namespace Tests\Integration;

use App\Repositories\EloquentPostSearchRepository;
use Tests\TestCase;

class EloquentPostSearchRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testActive()
    {
        $repository = new EloquentPostSearchRepository();
        $fetch = $repository->active()->fetch();
        $posts = $fetch->pluck('active');
        $posts->each(function ($post) {
            $this->assertEquals(true, $post, "Some posts isn't active");
        });
    }

    public function testInactive()
    {
        $repository = new EloquentPostSearchRepository();
        $fetch = $repository->active()->fetch();
        $posts = $fetch->pluck('inactive');
        $posts->each(function ($post) {
            $this->assertEquals(false, $post, "Some posts isn't inactive");
        });
    }

    public function testLatest()
    {
        $repository = new EloquentPostSearchRepository();
        $fetch = $repository->latest()->fetch();
        $posts = $fetch->pluck('created_at');
        for ($i = 0; $i < count($posts); $i++) {
            $this->assertLessThan(strtotime($posts[$i]), strtotime($posts[$i += 1]), "Posts are not sorted by latest date");
        }
    }

    public function testAlphabetical()
    {
        $repository = new EloquentPostSearchRepository();
        $fetch = $repository->alphabetically()->fetch();
        $posts = $fetch->pluck('name');
        for ($i = 0; $i < count($posts); $i++) {
            $this->assertGreaterThanOrEqual($posts[$i], $posts[$i += 1], "Posts are not sorted alphabetically");
        }
    }
}
