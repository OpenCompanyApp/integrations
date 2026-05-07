<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get member details.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/members/{userId}.
 */
class ClickHouseCloudMemberGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_member_get';
    protected const DESCRIPTION = 'Get member details

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/members/{userId}

Returns a single organization member details.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization the member is part of.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested user.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/members/{userId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
