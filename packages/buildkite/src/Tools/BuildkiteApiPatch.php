<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Call a safe relative Buildkite PATCH path.
 */
class BuildkiteApiPatch extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_api_patch';
    protected const DESCRIPTION = 'Call a safe relative Buildkite REST API PATCH path. Prefer named tools when available.';
    protected const METHOD = 'apiPatch';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path. Absolute URLs are rejected.'],
        'payload' => ['type' => 'object', 'description' => 'JSON payload.'],
    ];
}
