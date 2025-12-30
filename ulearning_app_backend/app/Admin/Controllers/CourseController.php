<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\CourseType;
use App\Models\Course;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;

class CourseController extends AdminController
{

    protected function grid()
    {
        $grid = new Grid(new Course());

        // the first argument is the db field
        $grid->column('id', __('Id'));

        //
        $grid->column('user_token', __('Teacher'))->display(
            function ($token) {
                //for futher processing data, you can create any method inside it or operation
                return  User::where('token', '=', $token)->value('name');
            }
        );
        $grid->column('name', __('Name'));
        // refers to th image size
        $grid->column('thumbnail', __('Thumbnail'))->image('', 50, 50);
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'));
        $grid->column('lesson_num', __('Lesson num'));
        $grid->column('video_length', __('Video length'));
        $grid->column('downloadable_res', __('Resources num'));
        $grid->column('created_at', __('Created at'));


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
        $show = new Show(Course::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('lesson_num', __('Lesson num'));
        $show->field('video_length', __('Video length'));
        $show->field('follow', __('Follow'));
        $show->field('score', __('Score'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }


    //create and editing
    protected function form()
    {

        $form = new Form(new Course());
        $form->text('name', __('Name'));

        //getout our Category
        //key value pair
        //last one is the key
        $result = CourseType::pluck('title', 'id');
        //select method helps you select one of the options the comes from result varibale
        $form->select('type_id', __('Category'))->options($result);
        $form->text('description', __('Description'));
        //file is used upload video or like pdf/docs
        $form->image('thumbnail', __('Thumbnail'))->uniqueName();

        $form->file('video', __('Video'))->uniqueName();
        //decimal method helps with retrieving float format from the database
        $form->decimal('price', __('Price'));
        $form->number('lesson_num', __('Lesson Number'));
        $form->number('video_length', __('Video Length'));
        $form->number('downloadable_res', __('Resources num'));
        //for the posting, who is posting
        $result = User::pluck('name', 'token');
        $form->select('user_token', __('Teacher'))->options($result);
        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));
        // $form->select('type_id', __('Parent Category'))->options((new CourseType)::selectOptions());
        // $form->text('title',__('Tilte'));//text is similar to string in laravel
        // $form->textarea('description',__('Description'));//textarea is similar to text
        // $form->number('order',__('Order')); //number is similar to int

        return $form;
    }
}
