<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Server Info.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/info.
 */
class LangSmithGetServerInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_server_info';
    protected const DESCRIPTION = 'Get Server Info

Official endpoint: GET /api/v1/info
Get information about the current deployment of LangSmith.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
