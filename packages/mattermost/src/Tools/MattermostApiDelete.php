<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Execute a raw Mattermost API DELETE request.
 *
 * Allows agents to call delete endpoints while common destructive actions remain explicit.
 */
class MattermostApiDelete extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_api_delete';
    protected const DESCRIPTION = 'Execute a raw DELETE request against the Mattermost REST API v4. Pass optional JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Mattermost API path relative to /api/v4.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
