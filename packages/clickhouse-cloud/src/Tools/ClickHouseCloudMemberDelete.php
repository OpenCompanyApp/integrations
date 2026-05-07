<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Remove an organization member.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/members/{userId}.
 */
class ClickHouseCloudMemberDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_member_delete';
    protected const DESCRIPTION = 'Remove an organization member

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/members/{userId}

Removes a user from the organization';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested user.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
