<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get private endpoint configuration.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/privateEndpointConfig.
 */
class ClickHouseCloudInstancePrivateEndpointConfigGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_private_endpoint_config_get';
    protected const DESCRIPTION = 'Get private endpoint configuration

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/privateEndpointConfig

Information required to set up a private endpoint';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested service.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/privateEndpointConfig';
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
