<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all repositories associated with current user..
 *
 * Maps to the official Cloudsmith endpoint get /repos/.
 */
class CloudsmithReposUserList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_user_list';
    protected const DESCRIPTION = 'Get a list of all repositories associated with current user.

Official Cloudsmith endpoint: GET /repos/

Get a list of all repositories associated with current user.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/repos/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
