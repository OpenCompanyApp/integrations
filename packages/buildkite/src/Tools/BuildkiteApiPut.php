<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Call a safe relative Buildkite PUT path.
 */
class BuildkiteApiPut extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_api_put';
    protected const DESCRIPTION = 'Call a safe relative Buildkite REST API PUT path. Prefer named tools when available.';
    protected const METHOD = 'apiPut';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path. Absolute URLs are rejected.'],
        'payload' => ['type' => 'object', 'description' => 'JSON payload.'],
    ];
}
