<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get backup details.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/backups/{backupId}.
 */
class ClickHouseCloudBackupGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_get';
    protected const DESCRIPTION = 'Get backup details

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/backups/{backupId}

Returns a single backup info.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the backup.',
    'required' => true,
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the service the backup was created from.',
    'required' => true,
  ),
  'backup_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested backup.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/backups/{backupId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
  'backupId' => 'backup_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
