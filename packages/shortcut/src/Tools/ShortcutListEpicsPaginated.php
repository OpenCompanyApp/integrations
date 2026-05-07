<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Epics Paginated.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/epics/paginated.
 */
class ShortcutListEpicsPaginated extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_epics_paginated';
    protected const DESCRIPTION = 'List Epics Paginated

Official Shortcut endpoint: GET /api/v3/epics/paginated.';
    protected const PARAMETERS = [
        'includes_description' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'A true/false boolean indicating whether to return Epics with their descriptions.',
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The page number to return, starting with 1. Defaults to 1.',
        ],
        'page_size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of Epics to return per page. Minimum 1, maximum 250, default 10.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/epics/paginated';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'includes_description' => 'includes_description',
        'page' => 'page',
        'page_size' => 'page_size',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
