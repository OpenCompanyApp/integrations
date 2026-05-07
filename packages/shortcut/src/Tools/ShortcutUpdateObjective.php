<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Objective.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/objectives/{objective-public-id}.
 */
class ShortcutUpdateObjective extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_objective';
    protected const DESCRIPTION = 'Update Objective

Official Shortcut endpoint: PUT /api/v3/objectives/{objective-public-id}.';
    protected const PARAMETERS = [
        'objective_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Objective.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/objectives/{objective-public-id}';
    protected const PATH_PARAMS = [
        'objective-public-id' => 'objective_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
