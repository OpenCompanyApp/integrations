<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteRole.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/roles/{roleID}.
 */
class PulumiOrganizationsDeleteRole extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_role';
    protected const DESCRIPTION = 'DeleteRole

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/roles/{roleID}

Deletes a custom role from an organization. If the role is currently assigned to members or teams, deletion requires the force parameter. Deleting a role revokes the permissions it granted to any assigned members or teams.';
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
  'force' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `force` from the official Pulumi Cloud API operation. Force deletion even if the role is currently assigned to members or teams',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/roles/{roleID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'roleID' => 'role_id',
);
    protected const QUERY_PARAMS = array (
  'force' => 'force',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
