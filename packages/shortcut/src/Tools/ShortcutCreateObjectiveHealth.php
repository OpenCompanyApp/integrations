<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Objective Health.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/objectives/{objective-public-id}/health.
 */
class ShortcutCreateObjectiveHealth extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_objective_health';
    protected const DESCRIPTION = 'Create Objective Health

Official Shortcut endpoint: POST /api/v3/objectives/{objective-public-id}/health.';
    protected const PARAMETERS = [
        'objective_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Objective.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/objectives/{objective-public-id}/health';
    protected const PATH_PARAMS = [
        'objective-public-id' => 'objective_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
