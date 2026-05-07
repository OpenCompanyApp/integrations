<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get service backup configuration.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/backupConfiguration.
 */
class ClickHouseCloudBackupConfigurationGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_configuration_get';
    protected const DESCRIPTION = 'Get service backup configuration

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/backupConfiguration

Returns the service backup configuration.';
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
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/backupConfiguration';
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
