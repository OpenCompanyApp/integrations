<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Execute a raw POST request against the LaunchDarkly REST API.
 */
class LaunchDarklyApiPost extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_api_post';
    protected const DESCRIPTION = 'Call any LaunchDarkly POST endpoint by path with a JSON request body.';
    protected const METHOD = 'POST';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to /api/v2.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'JSON request body. Some endpoints, such as member invites, expect a list.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
