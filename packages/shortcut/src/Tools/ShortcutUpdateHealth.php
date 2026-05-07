<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Health.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/health/{health-public-id}.
 */
class ShortcutUpdateHealth extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_health';
    protected const DESCRIPTION = 'Update Health

Official Shortcut endpoint: PUT /api/v3/health/{health-public-id}.';
    protected const PARAMETERS = [
        'health_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the Health record.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/health/{health-public-id}';
    protected const PATH_PARAMS = [
        'health-public-id' => 'health_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
