<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a package version (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/ecosystems/{ecosystem}/packages/{package_name}/versions/{package_version}.
 */
class SnykGetPackageVersion extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_package_version';
    protected const DESCRIPTION = 'Get a package version (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/ecosystems/{ecosystem}/packages/{package_name}/versions/{package_version}

Get package version metadata for a specific version of a package from an ecosystem. **Important:** The security section of `package_health` refers to the **specific version in the request**, not the latest version. Since the `overall_rating` is computed from all health sections (including security), it is also influenced by this version\'s security data. **Supported Ecosystems:** npm, pypi, maven, nuget, golang **Version Format:** Accepts standard semantic versioning formats (e.g., `1.2.3`, `v1.2.3`). **Note:** Golang commit hashes are NOT supported as version identifiers. Use tagged versions only. #### Required permissions - `View Organization (org.read)`';
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
  'package_version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `package_version` from the official Snyk API operation. Package version (URL encoded if needed). Accepts semantic versioning formats (e.g., 1.2.3, v1.2.3). Note: Golang commit hashes are NOT su...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/ecosystems/{ecosystem}/packages/{package_name}/versions/{package_version}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'ecosystem' => 'ecosystem',
  'package_name' => 'package_name',
  'package_version' => 'package_version',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
