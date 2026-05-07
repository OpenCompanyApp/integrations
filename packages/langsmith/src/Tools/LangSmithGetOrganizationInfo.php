<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Organization Info.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current.
 */
class LangSmithGetOrganizationInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_organization_info';
    protected const DESCRIPTION = 'Get Organization Info

Official endpoint: GET /api/v1/orgs/current
Get Organization Info.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
