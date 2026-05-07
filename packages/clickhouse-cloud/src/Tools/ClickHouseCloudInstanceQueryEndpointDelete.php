<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete the service query endpoint for a given instance.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint.
 */
class ClickHouseCloudInstanceQueryEndpointDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_query_endpoint_delete';
    protected const DESCRIPTION = 'Delete the service query endpoint for a given instance

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/services/{serviceId}/serviceQueryEndpoint

Removes the service query endpoint.';
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
    protected const METHOD = 'delete';
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
