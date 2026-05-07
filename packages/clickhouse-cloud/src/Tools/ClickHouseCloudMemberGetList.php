<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List organization members.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/members.
 */
class ClickHouseCloudMemberGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_member_get_list';
    protected const DESCRIPTION = 'List organization members

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/members

Returns a list of all members in the organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/members';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
