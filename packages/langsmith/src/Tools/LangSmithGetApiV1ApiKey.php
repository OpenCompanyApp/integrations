<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Api Keys.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/api-key.
 */
class LangSmithGetApiV1ApiKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_api_v1_api_key';
    protected const DESCRIPTION = 'Get Api Keys

Official endpoint: GET /api/v1/api-key
Get the current tenant\'s API keys';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/api-key';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
