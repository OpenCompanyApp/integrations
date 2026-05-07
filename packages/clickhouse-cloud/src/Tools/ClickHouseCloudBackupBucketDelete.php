<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete service backup bucket.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/services/{serviceId}/backupBucket.
 */
class ClickHouseCloudBackupBucketDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_bucket_delete';
    protected const DESCRIPTION = 'Delete service backup bucket

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/services/{serviceId}/backupBucket

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Delete service backup bucket. Requires ADMIN auth key role.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested service.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/backupBucket';
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
