<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an integration.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/{integration_id}.
 */
class FireHydrantGetIntegration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_integration';
    protected const DESCRIPTION = 'Get an integration

Official FireHydrant endpoint: GET /v1/integrations/{integration_id}

Retrieve a single integration';
    protected const PARAMETERS = array (
  'integration_id' =>
  array (
    'type' => 'string',
    'description' => 'Integration UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/{integration_id}';
    protected const PATH_PARAMS = array (
  'integration_id' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
