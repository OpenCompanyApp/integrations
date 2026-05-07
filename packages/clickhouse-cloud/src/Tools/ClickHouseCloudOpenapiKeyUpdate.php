<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update key.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/keys/{keyId}.
 */
class ClickHouseCloudOpenapiKeyUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_openapi_key_update';
    protected const DESCRIPTION = 'Update key

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/keys/{keyId}

Updates API key properties.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the key.',
    'required' => true,
  ),
  'key_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the key to update.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
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
