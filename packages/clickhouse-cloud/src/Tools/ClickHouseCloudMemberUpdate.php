<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update organization member.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/members/{userId}.
 */
class ClickHouseCloudMemberUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_member_update';
    protected const DESCRIPTION = 'Update organization member

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/members/{userId}

Updates organization member role.';
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
    'description' => 'ID of the user to patch',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
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
