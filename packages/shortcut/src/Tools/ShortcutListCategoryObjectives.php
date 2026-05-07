<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Category Objectives.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/categories/{category-public-id}/objectives.
 */
class ShortcutListCategoryObjectives extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_category_objectives';
    protected const DESCRIPTION = 'List Category Objectives

Official Shortcut endpoint: GET /api/v3/categories/{category-public-id}/objectives.';
    protected const PARAMETERS = [
        'category_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Category.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/categories/{category-public-id}/objectives';
    protected const PATH_PARAMS = [
        'category-public-id' => 'category_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
