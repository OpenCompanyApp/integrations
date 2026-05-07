<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get the service query endpoint for a given instance.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint.
 */
class ClickHouseCloudInstanceQueryEndpointGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_query_endpoint_get';
    protected const DESCRIPTION = 'Get the service query endpoint for a given instance

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint

Get the configuration for the service query endpoint that allows executing queries via API.';
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
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint';
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
