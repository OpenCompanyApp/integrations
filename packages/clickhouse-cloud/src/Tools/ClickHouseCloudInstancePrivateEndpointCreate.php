<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create a private endpoint.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/services/{serviceId}/privateEndpoint.
 */
class ClickHouseCloudInstancePrivateEndpointCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_private_endpoint_create';
    protected const DESCRIPTION = 'Create a private endpoint

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/services/{serviceId}/privateEndpoint

Create a new private endpoint. The private endpoint will be associated with this service and organization';
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
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/privateEndpoint';
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
