<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update service backup bucket.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/services/{serviceId}/backupBucket.
 */
class ClickHouseCloudBackupBucketUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_bucket_update';
    protected const DESCRIPTION = 'Update service backup bucket

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/services/{serviceId}/backupBucket

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Update service backup bucket. Requires ADMIN auth key role. The secrets of the specified bucket provider are always required';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
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
