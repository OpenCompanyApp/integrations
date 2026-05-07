<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get reverse private endpoint.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints/{reversePrivateEndpointId}.
 */
class ClickHouseCloudClickPipeReversePrivateEndpointGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_reverse_private_endpoint_get';
    protected const DESCRIPTION = 'Get reverse private endpoint

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints/{reversePrivateEndpointId}

Returns the reverse private endpoint with the specified ID.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the service.',
    'required' => true,
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the service that owns the Reverse Private Endpoint.',
    'required' => true,
  ),
  'reverse_private_endpoint_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the reverse private endpoint to get.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints/{reversePrivateEndpointId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
  'reversePrivateEndpointId' => 'reverse_private_endpoint_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
