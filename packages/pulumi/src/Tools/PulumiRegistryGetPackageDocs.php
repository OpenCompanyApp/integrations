<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPackageDocs.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/docs/{token}.
 */
class PulumiRegistryGetPackageDocs extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_get_package_docs';
    protected const DESCRIPTION = 'GetPackageDocs

Official Pulumi Cloud endpoint: GET /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/docs/{token}

Returns structured API documentation for a single resource or function identified by its Pulumi token. The token must be URL-encoded (e.g. \'random:index%2FrandomPassword:RandomPassword\'). The \'lang\' parameter is required and filters all property names, types, descriptions, and code examples to the specified language. Use the \'os\' parameter to collapse OS choosers in descriptions. Supports content negotiation via the Accept header: send \'text/markdown\' to receive a rendered markdown document with property tables instead of structured JSON. The version parameter accepts a specific semantic version string or \'latest\'. Returns 404 if the package version or token does not exist.';
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
  'token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `token` from the official Pulumi Cloud API operation. URL-encoded Pulumi token identifying the resource or function',
  ),
  'lang' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `lang` from the official Pulumi Cloud API operation. Language for filtering property names, types, descriptions, and code examples. Values: typescript, python, go, csharp, java, yaml',
  ),
  'os' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `os` from the official Pulumi Cloud API operation. Filter OS choosers in descriptions to a single OS. Values: linux, macos, windows',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/registry/packages/{source}/{publisher}/{name}/versions/{version}/docs/{token}';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
  'version' => 'version',
  'token' => 'token',
);
    protected const QUERY_PARAMS = array (
  'lang' => 'lang',
  'os' => 'os',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
