<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPackageExamples.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/examples.
 */
class PulumiRegistryGetPackageExamples extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_get_package_examples';
    protected const DESCRIPTION = 'GetPackageExamples

Official Pulumi Cloud endpoint: GET /api/registry/packages/{source}/{publisher}/{name}/versions/{version}/examples

Returns code examples aggregated from all resources and functions in a registry package version. Examples are extracted from PulumiCodeChooser blocks in each token\'s description; each example carries its \'token\' and \'kind\' so the flat list is self-contained. The \'lang\' parameter is required and selects the snippet language. Use the \'q\' parameter for case-insensitive substring search across each example\'s title and token; non-matching examples are omitted. The \'q\' value must be URL-encoded (e.g. spaces as \'%20\', \'/\' as \'%2F\'). Results are sorted by token (alphabetical) then by index within token. Use \'limit\' to cap the number of examples returned (default 20); the response reports \'totalCount\' (after filter, before limit) so consumers can detect when more results exist. Supports content negotiation via the Accept header: send \'text/markdown\' to receive a rendered listing instead of str...';
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
    'required' => true,
    'description' => 'Query parameter `lang` from the official Pulumi Cloud API operation. Snippet language. Values: typescript, python, go, csharp, java, yaml',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Pulumi Cloud API operation. Maximum number of examples to return (default: 20)',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `q` from the official Pulumi Cloud API operation. URL-encoded search query. Case-insensitive substring matching against each example\'s title and token',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/registry/packages/{source}/{publisher}/{name}/versions/{version}/examples';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'lang' => 'lang',
  'limit' => 'limit',
  'q' => 'q',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
