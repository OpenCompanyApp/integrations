<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List reverse private endpoints.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints.
 */
class ClickHouseCloudClickPipeReversePrivateEndpointGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_reverse_private_endpoint_get_list';
    protected const DESCRIPTION = 'List reverse private endpoints

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints

Returns a list of reverse private endpoints for the specified service.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
