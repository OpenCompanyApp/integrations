<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * List all available roles for an organization.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/roles.
 */
class ClickHouseCloudOrganizationRolesGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_roles_get_list';
    protected const DESCRIPTION = 'List all available roles for an organization

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/roles

Returns all available roles (system + custom) for an organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/roles';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
