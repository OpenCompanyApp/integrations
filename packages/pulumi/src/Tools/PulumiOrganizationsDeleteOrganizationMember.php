<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteOrganizationMember.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/members/{userLogin}.
 */
class PulumiOrganizationsDeleteOrganizationMember extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_organization_member';
    protected const DESCRIPTION = 'DeleteOrganizationMember

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/members/{userLogin}

Removes a user from an organization. The removed user loses access to all organization resources including stacks, teams, and projects. The caller cannot remove themselves from the organization. The user is also removed from all teams they belong to within the organization.';
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
);
    protected const METHOD = 'delete';
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
