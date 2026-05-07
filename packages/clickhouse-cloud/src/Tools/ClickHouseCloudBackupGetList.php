<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List of service backups.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/backups.
 */
class ClickHouseCloudBackupGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_get_list';
    protected const DESCRIPTION = 'List of service backups

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/backups

Returns a list of all backups for the service. The most recent backups comes first in the list.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/backups';
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
