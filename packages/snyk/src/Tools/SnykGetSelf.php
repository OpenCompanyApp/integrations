<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * My User Details.
 *
 * Maps to the official Snyk endpoint get /self.
 */
class SnykGetSelf extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_self';
    protected const DESCRIPTION = 'My User Details

Official Snyk endpoint: GET /self

Retrieves information about the the user making the request.';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/self';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
