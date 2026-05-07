<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get ClickHouse setting.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings/{settingName}.
 */
class ClickHouseCloudServiceClickhouseSettingGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_service_clickhouse_setting_get';
    protected const DESCRIPTION = 'Get ClickHouse setting

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings/{settingName}

**Disclaimer:** This beta endpoint is evolving; the API contract may change.  Returns the current value of a ClickHouse setting for the service. Use the [schema endpoint](#tag/Service/operation/serviceClickhouseSettingsSchemaGet) to discover which settings are configurable.';
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
  'setting_name' =>
  array (
    'type' => 'string',
    'description' => 'Name of the setting to retrieve.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickhouseSettings/{settingName}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
  'settingName' => 'setting_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
