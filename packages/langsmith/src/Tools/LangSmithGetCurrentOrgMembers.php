<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Org Members.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/members.
 */
class LangSmithGetCurrentOrgMembers extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_org_members';
    protected const DESCRIPTION = 'Get Current Org Members

Official endpoint: GET /api/v1/orgs/current/members
Get Current Org Members.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/members';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
