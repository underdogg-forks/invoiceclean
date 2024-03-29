<?php

namespace App\Ninja\Datatables;

use Auth;
use URL;
use Utils;

class ProposalCategoryDatatable extends EntityDatatable
{
    public $entityType = ENTITY_PROPOSAL_CATEGORY;
    public $sortCol = 1;

    public function columns()
    {
        return [
            [
                'name',
                function ($model) {
                    if (!Auth::user()->can('editByOwner', [ENTITY_PROPOSAL_CATEGORY, $model->user_id])) {
                        return $model->name;
                    }

                    return link_to("proposals/categories/{$model->public_id}/edit", $model->name)->toHtml();
                },
            ],
        ];
    }

    public function actions()
    {
        return [
            [
                trans('texts.edit_category'),
                function ($model) {
                    return URL::to("proposals/categories/{$model->public_id}/edit");
                },
                function ($model) {
                    return Auth::user()->can('editByOwner', [ENTITY_PROPOSAL_CATEGORY, $model->user_id]);
                },
            ],
        ];
    }
}
