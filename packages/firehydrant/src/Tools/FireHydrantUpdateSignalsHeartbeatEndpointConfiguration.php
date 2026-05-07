<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a heartbeat endpoint configuration.
 *
 * Maps to the official FireHydrant endpoint patch /v1/signals/heartbeat_endpoints/{id}.
 */
class FireHydrantUpdateSignalsHeartbeatEndpointConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_signals_heartbeat_endpoint_configuration';
    protected const DESCRIPTION = 'Update a heartbeat endpoint configuration

Official FireHydrant endpoint: PATCH /v1/signals/heartbeat_endpoints/{id}

Update an existing heartbeat endpoint configuration';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/signals/heartbeat_endpoints/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
