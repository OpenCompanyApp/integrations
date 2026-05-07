<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Call a safe relative Buildkite GET path.
 */
class BuildkiteApiGet extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_api_get';
    protected const DESCRIPTION = 'Call a safe relative Buildkite REST API GET path. Prefer named tools when available.';
    protected const METHOD = 'apiGet';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path, such as /organizations. Absolute URLs are rejected.'],
        'query' => ['type' => 'object', 'description' => 'Query parameters.'],
    ];
}
