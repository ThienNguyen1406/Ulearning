<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\CourseType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;

class CourseTypeController extends AdminController
{

    //actually for showing tree form of the menus
    public function index(Content $content){
        $tree = new Tree(new CourseType);

        return $content->header('Course Types') -> body($tree);
    }

      protected function detail($id)
    {
        $show = new Show(CourseType :: findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Category'));
        $show->field('description', __('Descripton'));
         $show->field('order', __('Order'));
        // $grid->column('access_token', __('Access Token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        // $show->disabaleActions();

        // $show->disableCreateButton();
        // $show->disableExport();
        // $show->disableFilter();

        return $show;
    }


    //create and editing
     protected function form()
    {
        
        $form = new Form(new CourseType());

        $form->select('parent_id', __('Parent Category'))->options((new CourseType)::selectOptions());
        $form->text('title',__('Tilte'));//text is similar to string in laravel
        $form->textarea('description',__('Description'));//textarea is similar to text
        $form->number('order',__('Order')); //number is similar to int

        return $form;
    
    }
}
