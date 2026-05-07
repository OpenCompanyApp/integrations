<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Category.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/categories/{category-public-id}.
 */
class ShortcutDeleteCategory extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_category';
    protected const DESCRIPTION = 'Delete Category

Official Shortcut endpoint: DELETE /api/v3/categories/{category-public-id}.';
    protected const PARAMETERS = [
        'category_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Category.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v3/categories/{category-public-id}';
    protected const PATH_PARAMS = [
        'category-public-id' => 'category_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
