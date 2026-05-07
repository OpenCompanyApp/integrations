<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create key.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/keys.
 */
class ClickHouseCloudOpenapiKeyCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_openapi_key_create';
    protected const DESCRIPTION = 'Create key

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/keys

Creates new API key.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that will own the key.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
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
