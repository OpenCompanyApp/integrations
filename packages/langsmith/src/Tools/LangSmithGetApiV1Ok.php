<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Ok.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/ok.
 */
class LangSmithGetApiV1Ok extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_api_v1_ok';
    protected const DESCRIPTION = 'Ok

Official endpoint: GET /api/v1/ok
Ok.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/ok';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
