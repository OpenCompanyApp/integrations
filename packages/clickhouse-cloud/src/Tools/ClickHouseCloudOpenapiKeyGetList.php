<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get list of all keys.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/keys.
 */
class ClickHouseCloudOpenapiKeyGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_openapi_key_get_list';
    protected const DESCRIPTION = 'Get list of all keys

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/keys

Returns a list of all keys in the organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/keys';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
