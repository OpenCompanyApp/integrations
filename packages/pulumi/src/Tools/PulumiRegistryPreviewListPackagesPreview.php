<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPackages.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/registry/packages.
 */
class PulumiRegistryPreviewListPackagesPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_list_packages_preview';
    protected const DESCRIPTION = 'ListPackages

Official Pulumi Cloud endpoint: GET /api/preview/registry/packages

Retrieves all registry packages accessible to the caller, with support for filtering, sorting, and pagination. No authentication is required, but authenticated requests may include additional usage statistics per package. Results can be filtered by package name, publisher, owning organization, sort field, and visibility level. Results are paginated with a default limit of 100 per page; use the continuationToken from the response to retrieve subsequent pages. Each entry in the response contains the full package metadata including name, publisher, source, version, title, description, repository URL, category, featured status, package types, maturity status, readme URL, schema URL, creation timestamp, and visibility.';
    protected const PARAMETERS = array (
  'asc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `asc` from the official Pulumi Cloud API operation. When true, sort results in ascending order',
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
    'description' => 'Query parameter `limit` from the official Pulumi Cloud API operation. Results per page (default: 100)',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Pulumi Cloud API operation. Filter by specific package name',
  ),
  'org_login' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `orgLogin` from the official Pulumi Cloud API operation. Filter by owning organization',
  ),
  'publisher' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `publisher` from the official Pulumi Cloud API operation. Filter by publisher organization',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Pulumi Cloud API operation. Sort field for results',
  ),
  'visibility' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `visibility` from the official Pulumi Cloud API operation. Filter by visibility level',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/registry/packages';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'asc' => 'asc',
  'continuationToken' => 'continuation_token',
  'limit' => 'limit',
  'name' => 'name',
  'orgLogin' => 'org_login',
  'publisher' => 'publisher',
  'sort' => 'sort',
  'visibility' => 'visibility',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
