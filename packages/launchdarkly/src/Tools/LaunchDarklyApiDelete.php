<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Execute a raw DELETE request against the LaunchDarkly REST API.
 */
class LaunchDarklyApiDelete extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_api_delete';
    protected const DESCRIPTION = 'Call any LaunchDarkly DELETE endpoint by path.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to /api/v2.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body for endpoints that accept one.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
