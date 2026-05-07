<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Categories.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/categories.
 */
class ShortcutListCategories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_categories';
    protected const DESCRIPTION = 'List Categories

Official Shortcut endpoint: GET /api/v3/categories.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/categories';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
