<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update service backup configuration.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/services/{serviceId}/backupConfiguration.
 */
class ClickHouseCloudBackupConfigurationUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_configuration_update';
    protected const DESCRIPTION = 'Update service backup configuration

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/services/{serviceId}/backupConfiguration

Updates service backup configuration. Requires ADMIN auth key role. Setting the properties with null value, will reset the properties to theirs default values.';
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
