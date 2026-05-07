<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateOrganizationSettings.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}.
 */
class PulumiOrganizationsUpdateOrganizationSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_organization_settings';
    protected const DESCRIPTION = 'UpdateOrganizationSettings

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}

Updates an organization\'s settings, such as the default stack permission level for new members, whether members can create teams, and other organization-wide configuration options. Returns the updated organization metadata.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
