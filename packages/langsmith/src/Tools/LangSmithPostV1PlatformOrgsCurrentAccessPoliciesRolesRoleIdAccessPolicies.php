<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Attach access policies to a role.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/orgs/current/access-policies/roles/{role_id}/access-policies.
 */
class LangSmithPostV1PlatformOrgsCurrentAccessPoliciesRolesRoleIdAccessPolicies extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_orgs_current_access_policies_roles_role_id_access_policies';
    protected const DESCRIPTION = 'Attach access policies to a role

Official endpoint: POST /v1/platform/orgs/current/access-policies/roles/{role_id}/access-policies
Attaches one or more access policies to a specific role. The request body must contain an array of access policy IDs.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/orgs/current/access-policies/roles/{role_id}/access-policies';
    protected const PATH_PARAMS = array (
  0 => 'role_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
