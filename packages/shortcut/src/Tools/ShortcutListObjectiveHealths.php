<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Objective Healths.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/objectives/{objective-public-id}/health-history.
 */
class ShortcutListObjectiveHealths extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_objective_healths';
    protected const DESCRIPTION = 'List Objective Healths

Official Shortcut endpoint: GET /api/v3/objectives/{objective-public-id}/health-history.';
    protected const PARAMETERS = [
        'objective_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Objective.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/objectives/{objective-public-id}/health-history';
    protected const PATH_PARAMS = [
        'objective-public-id' => 'objective_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
