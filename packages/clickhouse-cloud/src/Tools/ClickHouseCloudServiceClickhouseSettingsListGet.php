<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List ClickHouse settings.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings.
 */
class ClickHouseCloudServiceClickhouseSettingsListGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_service_clickhouse_settings_list_get';
    protected const DESCRIPTION = 'List ClickHouse settings

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings

**Disclaimer:** This beta endpoint is evolving; the API contract may change.  Returns the configured ClickHouse settings for the service. Only settings that have been explicitly set are included.';
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
