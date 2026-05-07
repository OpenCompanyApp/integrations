<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Category.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/categories/{category-public-id}.
 */
class ShortcutUpdateCategory extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_category';
    protected const DESCRIPTION = 'Update Category

Official Shortcut endpoint: PUT /api/v3/categories/{category-public-id}.';
    protected const PARAMETERS = [
        'category_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Category you wish to update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/categories/{category-public-id}';
    protected const PATH_PARAMS = [
        'category-public-id' => 'category_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
