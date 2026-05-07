<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Organization Roles.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/roles.
 */
class LangSmithListOrganizationRoles extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_organization_roles';
    protected const DESCRIPTION = 'List Organization Roles

Official endpoint: GET /api/v1/orgs/current/roles
List Organization Roles.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
