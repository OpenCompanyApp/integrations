<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List access policies.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/orgs/current/access-policies.
 */
class LangSmithGetV1PlatformOrgsCurrentAccessPolicies extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_orgs_current_access_policies';
    protected const DESCRIPTION = 'List access policies

Official endpoint: GET /v1/platform/orgs/current/access-policies
Lists all access policies for the organization.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/orgs/current/access-policies';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
