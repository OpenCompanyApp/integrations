<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Objective.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/objectives/{objective-public-id}.
 */
class ShortcutGetObjective extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_objective';
    protected const DESCRIPTION = 'Get Objective

Official Shortcut endpoint: GET /api/v3/objectives/{objective-public-id}.';
    protected const PARAMETERS = [
        'objective_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Objective.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/objectives/{objective-public-id}';
    protected const PATH_PARAMS = [
        'objective-public-id' => 'objective_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
