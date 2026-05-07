<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create new service.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/services.
 */
class ClickHouseCloudInstanceCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_create';
    protected const DESCRIPTION = 'Create new service

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/services

Creates a new service in the organization, and returns the current service state and a password to access the service. The service is started asynchronously.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that will own the service.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/organizations/{organizationId}/services';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
