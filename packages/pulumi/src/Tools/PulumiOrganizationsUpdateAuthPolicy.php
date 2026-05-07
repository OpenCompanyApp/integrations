<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateAuthPolicy.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/auth/policies/{policyId}.
 */
class PulumiOrganizationsUpdateAuthPolicy extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_auth_policy';
    protected const DESCRIPTION = 'UpdateAuthPolicy

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/auth/policies/{policyId}

Updates an authentication policy for an organization. Authentication policies define rules for how OIDC tokens are validated and what access they grant, including claim mappings, trust conditions, and role assignments. The policy definition cannot be empty. The request body contains a `policies` array where each policy object includes: - `decision`: `allow` or `deny` - `tokenType`: `organization`, `team`, `personal`, or `runner` - `teamName`: required when tokenType is `team` - `userLogin`: required when tokenType is `personal` - `runnerID`: required when tokenType is `runner` - `authorizedPermissions`: array of permissions (only `admin` is supported for organization tokens) - `rules`: object defining claim-matching rules for the token For more information about authorization rules, refer to the [OIDC authorization policies documentation](https://www.pulumi.com/docs/pulumi-cloud/acces...';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policyId` from the official Pulumi Cloud API operation. The policy identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/auth/policies/{policyId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'policyId' => 'policy_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
