<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Call a safe relative Buildkite POST path.
 */
class BuildkiteApiPost extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_api_post';
    protected const DESCRIPTION = 'Call a safe relative Buildkite REST API POST path. Prefer named tools when available.';
    protected const METHOD = 'apiPost';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path. Absolute URLs are rejected.'],
        'payload' => ['type' => 'object', 'description' => 'JSON payload.'],
    ];
}
