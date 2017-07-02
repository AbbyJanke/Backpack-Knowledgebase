<?php

namespace Abby\Knowledgebase\app\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Abby\Knowledgebase\app\Http\Requests\SpaceRequest as StoreRequest;
use Abby\Knowledgebase\app\Http\Requests\SpaceRequest as UpdateRequest;

class ArticleCrudController extends CrudController
{
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("Abby\Knowledgebase\app\Models\Article");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/knowledgebase/article');
        $this->crud->setEntityNameStrings(trans('backpack::knowledgebase.article'), trans('backpack::knowledgebase.articles'));

        $this->crud->allowAccess('show');
        $this->crud->setShowView('vendor.backpack.knowledgebase.article');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'title',
                                'label' => 'Title',
                            ]);
        $this->crud->addColumn([
                                'name' => 'slug',
                                'label' => 'Slug',
                            ]);
        $this->crud->addColumn([
                                'name' => 'private',
                                'label' => 'Private',
                                'type' => 'check'
                            ]);

        // ------ CRUD FIELDS
        $this->crud->addField([    // TEXT
                                'name' => 'title',
                                'label' => 'Title',
                                'type' => 'text',
                                'placeholder' => 'Your title here',
                            ]);
        $this->crud->addField([
                                'name' => 'slug',
                                'label' => 'Slug (URL)',
                                'type' => 'text',
                                'hint' => 'Will be automatically generated from your title, if left empty.',
                            ]);
        $this->crud->addField([
                                'name' => 'space_id',
                                'label' => 'Space',
                                'type' => 'select',
                                'entity' => 'space',
                                'attribute' => 'title',
                                'model' => 'Abby\Knowledgebase\app\Models\Space'
                            ]);
        $this->crud->addField([
                                // WYSIWYG
                                'name' => 'content',
                                'label' => 'Content',
                                'type' => 'ckeditor',
                                'placeholder' => 'Your textarea text here',
                            ]);
        $this->crud->addField([
                                'name' => 'private',
                                'label' => 'Keep this article private?',
                                'type' => 'checkbox'
                            ]);

        $this->crud->enableAjaxTable();
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }

    public function exportWord($id)
    {
        $this->crud->hasAccessOrFail('show');

        // get the info for that entry
        $entry = $this->crud->getEntry($id);
        $contentEdited = str_replace('https://dissociativeliving.dev', public_path(), $entry->content);
        $content = $entry->title.$contentEdited;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        //return view($this->crud->getShowView(), $this->data);

        $headers = [
            'Content-type' => 'text/html',
            'Content-Disposition' => 'attachment;Filename='.$entry->slug.'.doc'
        ];

        return \Response::make($content, 200, $headers);
    }

    public function exportPDF($id)
    {
        $this->crud->hasAccessOrFail('show');

        // get the info for that entry
        $entry = $this->crud->getEntry($id);
        $content = str_replace('https://dissociativeliving.dev', public_path(), $entry->content);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>'.$entry->title.'</h1>'.$content);
        return $pdf->download($entry->slug.'.pdf');
    }
}
