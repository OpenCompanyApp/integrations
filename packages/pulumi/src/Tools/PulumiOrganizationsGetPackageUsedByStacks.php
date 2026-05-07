<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPackageUsedByStacks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/packages/usage.
 */
class PulumiOrganizationsGetPackageUsedByStacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_package_used_by_stacks';
    protected const DESCRIPTION = 'GetPackageUsedByStacks

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/packages/usage

Returns the stacks within an organization that use a specific Pulumi package, helping track package adoption and identify affected stacks when planning package upgrades or deprecations.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. The continuation token',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Pulumi Cloud API operation. Maximum number of results to return per page. Defaults to 100, maximum 500.',
  ),
  'package_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `packageName` from the official Pulumi Cloud API operation. The package name',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Pulumi Cloud API operation. Filter to stacks using this specific version. If omitted, returns stacks using any version.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/packages/usage';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'limit' => 'limit',
  'packageName' => 'package_name',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
