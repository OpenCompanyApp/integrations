<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List heartbeat endpoint configurations.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/heartbeat_endpoints.
 */
class FireHydrantListSignalsHeartbeatEndpointConfigurations extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_signals_heartbeat_endpoint_configurations';
    protected const DESCRIPTION = 'List heartbeat endpoint configurations

Official FireHydrant endpoint: GET /v1/signals/heartbeat_endpoints

Retrieve all heartbeat endpoint configurations for your organization';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/heartbeat_endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
