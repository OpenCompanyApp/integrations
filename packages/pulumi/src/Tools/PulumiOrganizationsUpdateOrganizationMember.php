<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateOrganizationMember.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/members/{userLogin}.
 */
class PulumiOrganizationsUpdateOrganizationMember extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_organization_member';
    protected const DESCRIPTION = 'UpdateOrganizationMember

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/members/{userLogin}

Modifies a user\'s role within an organization. Set `role` to assign a built-in role (`member`, `admin`, or `billingManager`), or set `fgaRoleId` to assign a custom role. If both are provided, `fgaRoleId` takes precedence.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'user_login' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userLogin` from the official Pulumi Cloud API operation. The user login name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/members/{userLogin}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'userLogin' => 'user_login',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
