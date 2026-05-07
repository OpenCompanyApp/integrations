<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Call a safe relative Buildkite DELETE path.
 */
class BuildkiteApiDelete extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_api_delete';
    protected const DESCRIPTION = 'Call a safe relative Buildkite REST API DELETE path. Prefer named tools when available.';
    protected const METHOD = 'apiDelete';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path. Absolute URLs are rejected.'],
        'query' => ['type' => 'object', 'description' => 'Query parameters.'],
    ];
}
