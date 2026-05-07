<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the API key assigned to the user that is currently authenticated..
 *
 * Maps to the official Cloudsmith endpoint get /user/tokens/.
 */
class CloudsmithUserTokensList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_user_tokens_list';
    protected const DESCRIPTION = 'Retrieve the API key assigned to the user that is currently authenticated.

Official Cloudsmith endpoint: GET /user/tokens/

Retrieve the API key assigned to the user that is currently authenticated.';
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
    protected const PATH = '/user/tokens/';
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
