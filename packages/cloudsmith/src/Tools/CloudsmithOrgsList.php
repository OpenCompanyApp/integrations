<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all the organizations you are associated with..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/.
 */
class CloudsmithOrgsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_list';
    protected const DESCRIPTION = 'Get a list of all the organizations you are associated with.

Official Cloudsmith endpoint: GET /orgs/

Get a list of all the organizations you are associated with.';
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
    protected const PATH = '/orgs/';
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
