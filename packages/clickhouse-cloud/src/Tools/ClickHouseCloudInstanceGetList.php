<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List of organization services.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services.
 */
class ClickHouseCloudInstanceGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_get_list';
    protected const DESCRIPTION = 'List of organization services

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services

Returns a list of all services in the organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'filter' =>
  array (
    'type' => 'array',
    'description' => 'Filter criteria to apply when retrieving the resource. Currently, only filtering by resource tags is supported.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
  'filter' => 'filter',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
