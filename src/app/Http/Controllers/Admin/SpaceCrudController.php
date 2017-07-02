<?php

namespace Abby\Knowledgebase\app\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Abby\Knowledgebase\app\Http\Requests\SpaceRequest as StoreRequest;
use Abby\Knowledgebase\app\Http\Requests\SpaceRequest as UpdateRequest;

class SpaceCrudController extends CrudController
{
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("Abby\Knowledgebase\app\Models\Space");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/knowledgebase/space');
        $this->crud->setEntityNameStrings(trans('backpack::knowledgebase.space'), trans('backpack::knowledgebase.spaces'));

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'icon',
                                'label' => 'Icon',
                                'type' => 'icon-fontawesome'
                            ]);
        $this->crud->addColumn([
                                'name' => 'title',
                                'label' => 'Title',
                            ]);
        $this->crud->addColumn([
                                'name' => 'slug',
                                'label' => 'Slug',
                            ]);
        $this->crud->addColumn([
                                'name' => 'description',
                                'label' => 'Description',
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
        $this->crud->addField([    // TEXT
                                'name' => 'icon',
                                'label' => 'Icon',
                                'type' => 'icon_picker',
                                'iconset' => 'fontawesome',
                            ]);
        $this->crud->addField([
                                'name' => 'description',
                                'label' => 'Description',
                                'type' => 'text',
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
}
