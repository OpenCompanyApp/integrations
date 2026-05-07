<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Execute a raw PUT request against the LaunchDarkly REST API.
 */
class LaunchDarklyApiPut extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_api_put';
    protected const DESCRIPTION = 'Call any LaunchDarkly PUT endpoint by path with a JSON request body.';
    protected const METHOD = 'PUT';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to /api/v2.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'JSON request body.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
