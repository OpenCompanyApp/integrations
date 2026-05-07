<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateOrganizationDefaultRole.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/roles/{roleID}/default.
 */
class PulumiOrganizationsUpdateOrganizationDefaultRole extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_organization_default_role';
    protected const DESCRIPTION = 'UpdateOrganizationDefaultRole

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/roles/{roleID}/default

Sets the default custom role for the organization. New members who join the organization will be automatically assigned this role unless a different role is specified during the invitation process.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/roles/{roleID}/default';
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
