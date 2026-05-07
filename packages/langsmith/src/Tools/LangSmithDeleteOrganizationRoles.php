<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Organization Roles.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/orgs/current/roles/{role_id}.
 */
class LangSmithDeleteOrganizationRoles extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_organization_roles';
    protected const DESCRIPTION = 'Delete Organization Roles

Official endpoint: DELETE /api/v1/orgs/current/roles/{role_id}
Delete Organization Roles.';
    protected const PARAMETERS = array (
  'role_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `role_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/orgs/current/roles/{role_id}';
    protected const PATH_PARAMS = array (
  0 => 'role_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
