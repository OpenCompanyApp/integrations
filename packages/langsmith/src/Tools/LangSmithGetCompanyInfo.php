<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Company Info.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/business-info.
 */
class LangSmithGetCompanyInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_company_info';
    protected const DESCRIPTION = 'Get Company Info

Official endpoint: GET /api/v1/orgs/current/business-info
Get Company Info.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/business-info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
