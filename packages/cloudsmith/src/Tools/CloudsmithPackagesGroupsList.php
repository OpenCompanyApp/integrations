<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Return a list of Package Groups in a repository..
 *
 * Maps to the official Cloudsmith endpoint get /packages/{owner}/{repo}/groups/.
 */
class CloudsmithPackagesGroupsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_groups_list';
    protected const DESCRIPTION = 'Return a list of Package Groups in a repository.

Official Cloudsmith endpoint: GET /packages/{owner}/{repo}/groups/

Return a list of Package Groups in a repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
  'group_by' => array (
  'type' => 'string',
  'description' => 'A field to group packages by. Available options: name, backend_kind.',
),
  'hide_subcomponents' => array (
  'type' => 'string',
  'description' => 'Whether to hide packages which are subcomponents of another package in the results',
),
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying names, filenames, versions, distributions, architectures, formats, or statuses of packages.',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order. Use `-` prefix for descending order (e.g., `-name`). Available options: name, count, num_downloads, size, last_push, backend_kind.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/packages/{owner}/{repo}/groups/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'group_by' => 'group_by',
  'hide_subcomponents' => 'hide_subcomponents',
  'query' => 'query',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
