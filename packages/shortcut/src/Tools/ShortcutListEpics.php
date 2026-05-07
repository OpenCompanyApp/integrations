<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Epics.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/epics.
 */
class ShortcutListEpics extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_epics';
    protected const DESCRIPTION = 'List Epics

Official Shortcut endpoint: GET /api/v3/epics.';
    protected const PARAMETERS = [
        'includes_description' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'A true/false boolean indicating whether to return Epics with their descriptions.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/epics';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'includes_description' => 'includes_description',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
