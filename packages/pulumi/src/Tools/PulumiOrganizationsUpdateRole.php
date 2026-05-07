<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateRole.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/roles/{roleID}.
 */
class PulumiOrganizationsUpdateRole extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_role';
    protected const DESCRIPTION = 'UpdateRole

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/roles/{roleID}

Updates an existing custom role\'s name, description, or permission scopes. Changes take effect immediately for all members and teams assigned to the role.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/roles/{roleID}';
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
