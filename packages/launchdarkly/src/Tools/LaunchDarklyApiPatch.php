<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Execute a raw PATCH request against the LaunchDarkly REST API.
 */
class LaunchDarklyApiPatch extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_api_patch';
    protected const DESCRIPTION = 'Call any LaunchDarkly PATCH endpoint by path. LaunchDarkly commonly expects JSON Patch, JSON merge patch, or semantic patch bodies.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to /api/v2.'],
        'patch' => ['type' => 'array', 'description' => 'JSON Patch list, or semantic patch object when represented by the host as an array/object.'],
        'body' => ['type' => 'object', 'description' => 'Alternate request body for JSON merge patch or semantic patch payloads.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
