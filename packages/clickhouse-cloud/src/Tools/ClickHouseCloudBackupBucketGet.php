<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get service backup bucket.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/backupBucket.
 */
class ClickHouseCloudBackupBucketGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_backup_bucket_get';
    protected const DESCRIPTION = 'Get service backup bucket

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/backupBucket

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  Returns the service backup bucket.';
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
