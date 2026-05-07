<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all packages associated with repository..
 *
 * Maps to the official Cloudsmith endpoint get /packages/{owner}/{repo}/.
 */
class CloudsmithPackagesList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_list';
    protected const DESCRIPTION = 'Get a list of all packages associated with repository.

Official Cloudsmith endpoint: GET /packages/{owner}/{repo}/

Get a list of all packages associated with repository.';
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
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying names, filenames, versions, distributions, architectures, formats or statuses of packages.',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/packages/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
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
