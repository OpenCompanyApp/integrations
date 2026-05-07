<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete service.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/services/{serviceId}.
 */
class ClickHouseCloudInstanceDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_delete';
    protected const DESCRIPTION = 'Delete service

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/services/{serviceId}

Deletes the service. The service must be in stopped state and is deleted asynchronously after this method call.';
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
    'description' => 'ID of the service to delete.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}';
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
