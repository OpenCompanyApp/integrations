<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Organization Info.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/info.
 */
class LangSmithGetCurrentOrganizationInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_organization_info';
    protected const DESCRIPTION = 'Get Current Organization Info

Official endpoint: GET /api/v1/orgs/current/info
Get Current Organization Info.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
