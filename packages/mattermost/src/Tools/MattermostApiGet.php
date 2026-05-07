<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Execute a raw Mattermost API GET request.
 *
 * Provides long-tail coverage for Mattermost REST API v4 endpoints.
 */
class MattermostApiGet extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_api_get';
    protected const DESCRIPTION = 'Execute a raw GET request against the Mattermost REST API v4. Use paths such as `/users` or `/api/v4/users`.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Mattermost API path relative to /api/v4.'],
        'query' => ['type' => 'object', 'description' => 'Query string parameters.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
