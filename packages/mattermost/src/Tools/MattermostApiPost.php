<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Execute a raw Mattermost API POST request.
 *
 * Useful for newer Mattermost endpoints not yet modeled as first-class tools.
 */
class MattermostApiPost extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_api_post';
    protected const DESCRIPTION = 'Execute a raw POST request against the Mattermost REST API v4. Pass JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Mattermost API path relative to /api/v4.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
