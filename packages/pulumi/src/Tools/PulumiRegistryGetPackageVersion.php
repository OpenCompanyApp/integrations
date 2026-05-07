<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPackageVersion.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/registry/packages/{source}/{publisher}/{name}/versions/{version}.
 */
class PulumiRegistryGetPackageVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_get_package_version';
    protected const DESCRIPTION = 'GetPackageVersion

Official Pulumi Cloud endpoint: GET /api/registry/packages/{source}/{publisher}/{name}/versions/{version}

Retrieves metadata for a specific version of a registry package. The package is identified by its source, publisher organization, and name. The version parameter accepts either a specific semantic version string or the special value \'latest\' to retrieve the most recently published version. The response includes the package\'s name, publisher, version, title, description, repository URL, category, featured status, package types, maturity status, readme URL, schema URL, plugin download URL, creation timestamp, visibility, parameterization details, and usage statistics (when the caller is authenticated). Returns 404 if the specified package version does not exist.';
    protected const PARAMETERS = array (
  'source' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `source` from the official Pulumi Cloud API operation. The package source: \'pulumi\', \'opentofu\', or \'private\'',
  ),
  'publisher' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `publisher` from the official Pulumi Cloud API operation. Organization that owns the package',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Pulumi Cloud API operation. The package name',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string or \'latest\'',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/registry/packages/{source}/{publisher}/{name}/versions/{version}';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
