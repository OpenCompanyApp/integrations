<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Upsert the service query endpoint for a given instance.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint.
 */
class ClickHouseCloudInstanceQueryEndpointUpsert extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_query_endpoint_upsert';
    protected const DESCRIPTION = 'Upsert the service query endpoint for a given instance

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint

Create the service query endpoint that allows executing queries via API.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
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
