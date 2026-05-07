<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Execute a raw Mattermost API PUT request.
 *
 * Covers idempotent Mattermost REST API v4 endpoints.
 */
class MattermostApiPut extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_api_put';
    protected const DESCRIPTION = 'Execute a raw PUT request against the Mattermost REST API v4. Pass optional JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Mattermost API path relative to /api/v4.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
