<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateDefaultOrganization.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/user/organizations/{orgName}/default.
 */
class PulumiUsersUpdateDefaultOrganization extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_update_default_organization';
    protected const DESCRIPTION = 'UpdateDefaultOrganization

Official Pulumi Cloud endpoint: POST /api/user/organizations/{orgName}/default

UpdateDefaultOrganization sets the default organization for the current user.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/user/organizations/{orgName}/default';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
