<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get ClickHouse settings schema.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings/schema.
 */
class ClickHouseCloudServiceClickhouseSettingsSchemaGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_service_clickhouse_settings_schema_get';
    protected const DESCRIPTION = 'Get ClickHouse settings schema

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings/schema

**Disclaimer:** This beta endpoint is evolving; the API contract may change.  Returns the schema of all configurable ClickHouse settings, including types, valid values, descriptions, and warnings.';
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
    'description' => 'ID of the service.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings/schema';
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
