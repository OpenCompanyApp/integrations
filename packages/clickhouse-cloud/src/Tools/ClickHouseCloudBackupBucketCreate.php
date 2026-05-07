<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create service backup bucket.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/services/{serviceId}/backupBucket.
 */
class ClickHouseCloudBackupBucketCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_bucket_create';
    protected const DESCRIPTION = 'Create service backup bucket

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/services/{serviceId}/backupBucket

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Create service backup bucket. Requires ADMIN auth key role.';
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
    protected const METHOD = 'post';
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
