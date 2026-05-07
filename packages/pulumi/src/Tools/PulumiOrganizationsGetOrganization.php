<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrganization.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}.
 */
class PulumiOrganizationsGetOrganization extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_organization';
    protected const DESCRIPTION = 'GetOrganization

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}

Returns detailed information about the specified organization, including its name, display name, avatar URL, enabled features, subscription tier, and access control settings. The response includes member count, team availability, and other configuration relevant to the caller\'s role within the organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
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
