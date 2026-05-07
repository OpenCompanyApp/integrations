<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrgTokensWithRole.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/roles/{roleID}/tokens.
 */
class PulumiOrganizationsListOrgTokensWithRole extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_org_tokens_with_role';
    protected const DESCRIPTION = 'ListOrgTokensWithRole

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/roles/{roleID}/tokens

Returns all organization tokens that have been assigned to a specific custom role. This helps administrators audit which tokens have particular permission levels and manage token-to-role assignments for least-privilege access.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'role_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `roleID` from the official Pulumi Cloud API operation. The role identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/roles/{roleID}/tokens';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'roleID' => 'role_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
