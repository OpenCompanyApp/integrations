<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Organization Roles.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/orgs/current/roles/{role_id}.
 */
class LangSmithUpdateOrganizationRoles extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_organization_roles';
    protected const DESCRIPTION = 'Update Organization Roles

Official endpoint: PATCH /api/v1/orgs/current/roles/{role_id}
Update Organization Roles.';
    protected const PARAMETERS = array (
  'role_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `role_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/orgs/current/roles/{role_id}';
    protected const PATH_PARAMS = array (
  0 => 'role_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
