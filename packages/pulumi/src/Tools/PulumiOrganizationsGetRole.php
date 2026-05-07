<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetRole.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/roles/{roleID}.
 */
class PulumiOrganizationsGetRole extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_role';
    protected const DESCRIPTION = 'GetRole

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/roles/{roleID}

Returns the details of a specific custom role, including its name, description, and the set of permission scopes it grants. Custom roles enable fine-grained access control beyond the built-in admin and member roles.';
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
