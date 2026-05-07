<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete an access policy.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/orgs/current/access-policies/{access_policy_id}.
 */
class LangSmithDeleteV1PlatformOrgsCurrentAccessPoliciesAccessPolicyId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_orgs_current_access_policies_access_policy_id';
    protected const DESCRIPTION = 'Delete an access policy

Official endpoint: DELETE /v1/platform/orgs/current/access-policies/{access_policy_id}
Deletes a specific access policy by ID.';
    protected const PARAMETERS = array (
  'access_policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `access_policy_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/orgs/current/access-policies/{access_policy_id}';
    protected const PATH_PARAMS = array (
  0 => 'access_policy_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
