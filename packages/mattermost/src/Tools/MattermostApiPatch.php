<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Execute a raw Mattermost API PATCH request.
 *
 * Supports long-tail update endpoints while common operations have first-class tools.
 */
class MattermostApiPatch extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_api_patch';
    protected const DESCRIPTION = 'Execute a raw PATCH request against the Mattermost REST API v4. Pass JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Mattermost API path relative to /api/v4.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
