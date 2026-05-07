<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListTemplateVersions.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/registry/templates/{source}/{publisher}/{name}/versions.
 */
class PulumiRegistryListTemplateVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_list_template_versions';
    protected const DESCRIPTION = 'ListTemplateVersions

Official Pulumi Cloud endpoint: GET /api/registry/templates/{source}/{publisher}/{name}/versions

Lists all versions of a specific template, ordered by version descending (latest first). The template is identified by its source, publisher organization, and name. Results are paginated with a default limit of 100 per page. Use the continuationToken from the response to retrieve subsequent pages. Each entry in the response contains the template version metadata. Returns 400 for an invalid continuationToken or 404 if the template does not exist.';
    protected const PARAMETERS = array (
  'source' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `source` from the official Pulumi Cloud API operation. The template source: \'private\', \'github\', or \'gitlab\'',
  ),
  'publisher' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `publisher` from the official Pulumi Cloud API operation. Organization that owns the template',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Pulumi Cloud API operation. The template name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Pagination token for retrieving the next page of results',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Pulumi Cloud API operation. Maximum number of results to return (default: 100)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/registry/templates/{source}/{publisher}/{name}/versions';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
