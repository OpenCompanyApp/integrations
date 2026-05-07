<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Organization activity.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/activities/{activityId}.
 */
class ClickHouseCloudActivityGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_activity_get';
    protected const DESCRIPTION = 'Organization activity

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/activities/{activityId}

Returns a single organization activity by ID.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'activity_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested activity.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/activities/{activityId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'activityId' => 'activity_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
