<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Execute a raw GET request against the LaunchDarkly REST API.
 */
class LaunchDarklyApiGet extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_api_get';
    protected const DESCRIPTION = 'Call any LaunchDarkly GET endpoint by path. Use this for newer or less common REST API resources not covered by a first-class tool.';
    protected const METHOD = 'GET';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to /api/v2, such as /projects or /flags/default/my-flag.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
