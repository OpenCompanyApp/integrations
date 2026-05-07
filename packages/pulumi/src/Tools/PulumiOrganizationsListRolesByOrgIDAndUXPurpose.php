<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListRolesByOrgIDAndUXPurpose.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/roles.
 */
class PulumiOrganizationsListRolesByOrgIDAndUXPurpose extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_roles_by_org_idand_uxpurpose';
    protected const DESCRIPTION = 'ListRolesByOrgIDAndUXPurpose

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/roles

Returns custom roles for an organization filtered by their UX purpose (e.g., \'organization\', \'team\', or \'token\'). This allows the UI to display only the roles relevant to the current context, such as showing only organization-level roles when managing member access.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'ux_purpose' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `uxPurpose` from the official Pulumi Cloud API operation. Filter roles by their UX purpose (e.g., \'organization\', \'team\', \'token\')',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/roles';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'uxPurpose' => 'ux_purpose',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
