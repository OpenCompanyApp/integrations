<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get key details.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/keys/{keyId}.
 */
class ClickHouseCloudOpenapiKeyGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_openapi_key_get';
    protected const DESCRIPTION = 'Get key details

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/keys/{keyId}

Returns a single key details.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'key_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested key.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/keys/{keyId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'keyId' => 'key_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
