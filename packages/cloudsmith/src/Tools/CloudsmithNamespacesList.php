<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all namespaces the user belongs to..
 *
 * Maps to the official Cloudsmith endpoint get /namespaces/.
 */
class CloudsmithNamespacesList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_namespaces_list';
    protected const DESCRIPTION = 'Get a list of all namespaces the user belongs to.

Official Cloudsmith endpoint: GET /namespaces/

Get a list of all namespaces the user belongs to.';
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
    protected const PATH = '/namespaces/';
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
