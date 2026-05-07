<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * SetSoleOrganizationAdmin.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/members/{userLogin}/set-admin.
 */
class PulumiOrganizationsSetSoleOrganizationAdmin extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_set_sole_organization_admin';
    protected const DESCRIPTION = 'SetSoleOrganizationAdmin

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/members/{userLogin}/set-admin

Promotes a member to administrator on organizations that are limited to a single admin. This endpoint is only valid for Team subscriptions (Team Starter and Team Growth) - it returns 400 on any other plan. On these plans, `UpdateOrganizationMember` cannot promote a member to admin, because doing so would require simultaneously demoting the current admin. This endpoint performs both changes atomically: the caller (who must be the current sole admin) is demoted to member and the target user is promoted to admin. **Note:** This endpoint operates on built-in roles only and does not integrate with custom roles.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/members/{userLogin}/set-admin';
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
