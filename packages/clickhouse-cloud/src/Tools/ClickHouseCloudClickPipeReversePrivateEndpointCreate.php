<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create reverse private endpoint.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints.
 */
class ClickHouseCloudClickPipeReversePrivateEndpointCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_pipe_reverse_private_endpoint_create';
    protected const DESCRIPTION = 'Create reverse private endpoint

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/services/{serviceId}/clickpipesReversePrivateEndpoints

Create a new reverse private endpoint.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
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
