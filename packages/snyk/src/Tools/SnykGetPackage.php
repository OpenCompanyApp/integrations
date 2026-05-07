<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a package (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/ecosystems/{ecosystem}/packages/{package_name}.
 */
class SnykGetPackage extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_package';
    protected const DESCRIPTION = 'Get a package (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/ecosystems/{ecosystem}/packages/{package_name}

Get package metadata for a specific package from an ecosystem. **Important:** The security section of `package_health` refers to the `latest_version` of the package, not all versions. Since the `overall_rating` is computed from all health sections (including security), it is also influenced by the latest version\'s security data. **Supported Ecosystems:** npm, pypi, maven, nuget, golang #### Required permissions - `View Organization (org.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'ecosystem' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ecosystem` from the official Snyk API operation. The package ecosystem',
    'enum' =>
    array (
      0 => 'npm',
      1 => 'pypi',
      2 => 'maven',
      3 => 'nuget',
      4 => 'golang',
    ),
  ),
  'package_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `package_name` from the official Snyk API operation. Package name (URL encoded if needed)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/ecosystems/{ecosystem}/packages/{package_name}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'ecosystem' => 'ecosystem',
  'package_name' => 'package_name',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
