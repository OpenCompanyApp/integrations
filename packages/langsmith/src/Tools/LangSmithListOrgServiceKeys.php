<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Org Service Keys.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/service-keys.
 */
class LangSmithListOrgServiceKeys extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_org_service_keys';
    protected const DESCRIPTION = 'List Org Service Keys

Official endpoint: GET /api/v1/orgs/current/service-keys
List Org Service Keys.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/service-keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
