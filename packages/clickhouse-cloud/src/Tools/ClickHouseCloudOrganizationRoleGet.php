<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get role details.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/roles/{roleId}.
 */
class ClickHouseCloudOrganizationRoleGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_role_get';
    protected const DESCRIPTION = 'Get role details

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/roles/{roleId}

Returns details for a specific role.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'role_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested role.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/roles/{roleId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'roleId' => 'role_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
