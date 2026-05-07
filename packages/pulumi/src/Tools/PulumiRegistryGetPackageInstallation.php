<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPackageInstallation.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/installation.
 */
class PulumiRegistryGetPackageInstallation extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_get_package_installation';
    protected const DESCRIPTION = 'GetPackageInstallation

Official Pulumi Cloud endpoint: GET /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/installation

Returns installation configuration content for a registry package version, structured as an ordered list of content nodes. Not all packages include installation configuration; this endpoint returns 404 when absent. Use the \'lang\' parameter to filter language-specific content to a single language (fallback chain: requested language, then Go, then first available). Use the \'os\' parameter to filter OS-specific content similarly (fallback: Linux). Supports content negotiation via the Accept header: send \'text/markdown\' to receive a clean rendered markdown string instead of structured JSON. The version parameter accepts a specific semantic version string or \'latest\'. Returns 404 if the specified package version does not exist or if the package does not include installation configuration.';
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
  'lang' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `lang` from the official Pulumi Cloud API operation. Filter language-specific content to a single language. Values: typescript, python, go, csharp, java, yaml',
  ),
  'os' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `os` from the official Pulumi Cloud API operation. Filter OS-specific content to a single OS. Values: linux, macos, windows',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/registry/packages/{source}/{publisher}/{name}/versions/{version}/installation';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'lang' => 'lang',
  'os' => 'os',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
