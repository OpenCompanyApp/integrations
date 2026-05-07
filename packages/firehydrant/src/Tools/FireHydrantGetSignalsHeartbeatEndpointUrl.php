<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get heartbeat endpoint URL.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/heartbeat_endpoints/addresses.
 */
class FireHydrantGetSignalsHeartbeatEndpointUrl extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_heartbeat_endpoint_url';
    protected const DESCRIPTION = 'Get heartbeat endpoint URL

Official FireHydrant endpoint: GET /v1/signals/heartbeat_endpoints/addresses

Retrieve the URL for a heartbeat endpoint';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/heartbeat_endpoints/addresses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
