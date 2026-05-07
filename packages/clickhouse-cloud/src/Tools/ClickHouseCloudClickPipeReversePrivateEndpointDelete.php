<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete reverse private endpoint.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints/{reversePrivateEndpointId}.
 */
class ClickHouseCloudClickPipeReversePrivateEndpointDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_reverse_private_endpoint_delete';
    protected const DESCRIPTION = 'Delete reverse private endpoint

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints/{reversePrivateEndpointId}

Delete the reverse private endpoint with the specified ID.';
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
    'description' => 'ID of the reverse private endpoint to delete.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
