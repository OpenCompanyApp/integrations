<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * getAPIVersion.
 *
 * Maps to the official Snyk endpoint get /openapi/{version}.
 */
class SnykGetAPIVersion extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_apiversion';
    protected const DESCRIPTION = 'getAPIVersion

Official Snyk endpoint: GET /openapi/{version}

Get OpenAPI specification effective at version.';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Snyk API operation. The requested version of the API',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/openapi/{version}';
    protected const PATH_PARAMS = array (
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
