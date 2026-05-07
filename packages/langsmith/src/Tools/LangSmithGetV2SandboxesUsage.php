<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get sandbox resource usage.
 *
 * Maps to the official LangSmith endpoint GET /v2/sandboxes/usage.
 */
class LangSmithGetV2SandboxesUsage extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_sandboxes_usage';
    protected const DESCRIPTION = 'Get sandbox resource usage

Official endpoint: GET /v2/sandboxes/usage
Get current sandbox resource usage and quota limits for the workspace';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/sandboxes/usage';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
