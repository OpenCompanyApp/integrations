<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Health Info.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/info/health.
 */
class LangSmithGetHealthInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_health_info';
    protected const DESCRIPTION = 'Get Health Info

Official endpoint: GET /api/v1/info/health
Get health information about the current deployment of LangSmith.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/info/health';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
