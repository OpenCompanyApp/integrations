<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List hub environments.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/hub/environments.
 */
class LangSmithGetApiV1HubEnvironments extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_api_v1_hub_environments';
    protected const DESCRIPTION = 'List hub environments

Official endpoint: GET /api/v1/hub/environments
Returns the hub environments model for the current tenant. Returns 404 if no custom configuration exists.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/hub/environments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
