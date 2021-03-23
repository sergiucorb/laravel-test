<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\Users;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

class PostsController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());
        $grid->quickSearch(['content', 'title','user_id']);
        $grid->column('id', __('Id'))->sortable();
        $grid->column('user_id', __('User id/User name'))->display(function ($user) {
            return Users::query()->findOrFail($user)->name;
        });
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'))->limit(50);
        $grid->column('active',__('STATUS'))->switch([
            'on' => ['value' => 1, 'text' => 'ACTIV', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'INACTIV', 'color' => 'danger'],
        ]);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {

        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Continut'));
        $show->field('active', __('Active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        //edit
        $form = new Form(new Post());
        $form->select('user_id','Select a user')->options(Users::all()->pluck('name','id'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));
        $form->switch('active', __('Active'));

        return $form;
    }
}
