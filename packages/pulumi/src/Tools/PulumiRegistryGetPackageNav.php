<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPackageNav.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/nav.
 */
class PulumiRegistryGetPackageNav extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_get_package_nav';
    protected const DESCRIPTION = 'GetPackageNav

Official Pulumi Cloud endpoint: GET /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/nav

Returns the module, resource, and function navigation tree for a registry package version. Names are resolved for the requested language (defaulting to Go when omitted). Use the \'q\' parameter for case-insensitive search: the tree is filtered to nodes whose name or token contains the query string, with ancestor module paths preserved. Modules with no matching children are omitted. Supports content negotiation via the Accept header: send \'text/markdown\' to receive a plain-text listing instead of structured JSON. The version parameter accepts a specific semantic version string or \'latest\'. Returns 404 if the specified package version does not exist.';
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
    'description' => 'Query parameter `lang` from the official Pulumi Cloud API operation. Language for name resolution. Names are resolved for this language with a fallback chain: requested language, then Go, then first availab...',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `q` from the official Pulumi Cloud API operation. Search query for filtering the navigation tree. Case-insensitive matching against resource/function names and tokens',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/registry/packages/{source}/{publisher}/{name}/versions/{version}/nav';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'lang' => 'lang',
  'q' => 'q',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
