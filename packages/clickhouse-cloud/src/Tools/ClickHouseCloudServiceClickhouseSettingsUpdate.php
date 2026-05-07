<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update ClickHouse settings.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings.
 */
class ClickHouseCloudServiceClickhouseSettingsUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_service_clickhouse_settings_update';
    protected const DESCRIPTION = 'Update ClickHouse settings

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings

**Disclaimer:** This beta endpoint is evolving; the API contract may change.  Updates one or more ClickHouse settings for the service. Use the [schema endpoint](#tag/Service/operation/serviceClickhouseSettingsSchemaGet) to discover which settings are configurable.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings';
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
