<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a heartbeat endpoint configuration.
 *
 * Maps to the official FireHydrant endpoint delete /v1/signals/heartbeat_endpoints/{id}.
 */
class FireHydrantDeleteSignalsHeartbeatEndpointConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_signals_heartbeat_endpoint_configuration';
    protected const DESCRIPTION = 'Delete a heartbeat endpoint configuration

Official FireHydrant endpoint: DELETE /v1/signals/heartbeat_endpoints/{id}

Delete a heartbeat endpoint configuration';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
