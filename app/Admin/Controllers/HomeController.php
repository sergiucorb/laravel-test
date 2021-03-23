<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->row(function ($row) {
                $row->column(3, new InfoBox('Users', 'users', 'aqua', 'admin/users', DB::table('users')->count()));
                $row->column(3, new InfoBox('Posts', 'briefcase', 'green', 'admin/posts', DB::table('posts')->count()));

            });

    }
}
