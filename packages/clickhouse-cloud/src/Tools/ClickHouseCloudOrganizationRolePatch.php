<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update a role.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/roles/{roleId}.
 */
class ClickHouseCloudOrganizationRolePatch extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_role_patch';
    protected const DESCRIPTION = 'Update a role

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/roles/{roleId}

Updates an existing custom role. System roles cannot be updated. All fields are optional - only provided fields will be updated.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
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
