<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Labels.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/labels.
 */
class ShortcutListLabels extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_labels';
    protected const DESCRIPTION = 'List Labels

Official Shortcut endpoint: GET /api/v3/labels.';
    protected const PARAMETERS = [
        'slim' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'A true/false boolean indicating if the slim versions of the Label should be returned.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/labels';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'slim' => 'slim',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
