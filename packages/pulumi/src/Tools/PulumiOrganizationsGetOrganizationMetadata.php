<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrganizationMetadata.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/metadata.
 */
class PulumiOrganizationsGetOrganizationMetadata extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_organization_metadata';
    protected const DESCRIPTION = 'GetOrganizationMetadata

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/metadata

GetOrganizationMetadata returns metadata about the given organization. This is designed to be an inexpensive call.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/metadata';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
