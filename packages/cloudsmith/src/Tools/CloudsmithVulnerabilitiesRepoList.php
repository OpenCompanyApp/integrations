<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Lists scan results for a specific repository..
 *
 * Maps to the official Cloudsmith endpoint get /vulnerabilities/{owner}/{repo}/.
 */
class CloudsmithVulnerabilitiesRepoList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_vulnerabilities_repo_list';
    protected const DESCRIPTION = 'Lists scan results for a specific repository.

Official Cloudsmith endpoint: GET /vulnerabilities/{owner}/{repo}/

Lists scan results for a specific repository.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/vulnerabilities/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
