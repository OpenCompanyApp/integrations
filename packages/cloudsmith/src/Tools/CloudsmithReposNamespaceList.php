<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all repositories within a namespace..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/.
 */
class CloudsmithReposNamespaceList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_namespace_list';
    protected const DESCRIPTION = 'Get a list of all repositories within a namespace.

Official Cloudsmith endpoint: GET /repos/{owner}/

Get a list of all repositories within a namespace.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
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
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying repositories. Available options are: name, slug. Explicit filters: broadcast_state, repository_type.',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/repos/{owner}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'query' => 'query',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
