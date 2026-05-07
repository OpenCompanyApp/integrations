<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * List CRAN upstream configs for this repository..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/{identifier}/upstream/cran/.
 */
class CloudsmithReposUpstreamCranList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_upstream_cran_list';
    protected const DESCRIPTION = 'List CRAN upstream configs for this repository.

Official Cloudsmith endpoint: GET /repos/{owner}/{identifier}/upstream/cran/

List CRAN upstream configs for this repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/repos/{owner}/{identifier}/upstream/cran/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
