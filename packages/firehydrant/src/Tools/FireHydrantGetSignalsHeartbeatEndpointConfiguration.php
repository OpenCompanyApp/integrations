<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a heartbeat endpoint configuration.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/heartbeat_endpoints/{id}.
 */
class FireHydrantGetSignalsHeartbeatEndpointConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_heartbeat_endpoint_configuration';
    protected const DESCRIPTION = 'Get a heartbeat endpoint configuration

Official FireHydrant endpoint: GET /v1/signals/heartbeat_endpoints/{id}

Retrieve a single heartbeat endpoint configuration';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/heartbeat_endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
