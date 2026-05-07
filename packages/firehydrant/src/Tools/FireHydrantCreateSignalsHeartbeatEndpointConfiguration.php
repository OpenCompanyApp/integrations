<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a heartbeat endpoint configuration.
 *
 * Maps to the official FireHydrant endpoint post /v1/signals/heartbeat_endpoints.
 */
class FireHydrantCreateSignalsHeartbeatEndpointConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_signals_heartbeat_endpoint_configuration';
    protected const DESCRIPTION = 'Create a heartbeat endpoint configuration

Official FireHydrant endpoint: POST /v1/signals/heartbeat_endpoints

Create a new heartbeat endpoint configuration for your organization';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/signals/heartbeat_endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
