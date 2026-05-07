<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AddOrganizationMember.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/members/{userLogin}.
 */
class PulumiOrganizationsAddOrganizationMember extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_add_organization_member';
    protected const DESCRIPTION = 'AddOrganizationMember

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/members/{userLogin}

Adds an existing Pulumi user to an organization with a built-in role. **Important:** The user must have already signed up for a Pulumi account before they can be added to an organization. This endpoint only assigns built-in roles. To onboard a user with a custom role, use the organization invite flow (`BatchCreateOrgInviteEmail`) and set `roleId` on the invite - the custom role is applied when the user accepts. Alternatively, add the user here with a built-in role and then call `UpdateOrganizationMember` with `fgaRoleId` to reassign. Returns the newly created organization member record. Returns 409 if the user is already a member of the organization.';
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
    protected const METHOD = 'post';
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
