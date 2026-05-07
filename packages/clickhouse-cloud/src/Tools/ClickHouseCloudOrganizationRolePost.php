<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create a new role.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/roles.
 */
class ClickHouseCloudOrganizationRolePost extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_role_post';
    protected const DESCRIPTION = 'Create a new role

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/roles

Creates a new custom role for an organization with specified policies and actors.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
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
