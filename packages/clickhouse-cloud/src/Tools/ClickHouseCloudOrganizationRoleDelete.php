<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Delete a role.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/roles/{roleId}.
 */
class ClickHouseCloudOrganizationRoleDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_role_delete';
    protected const DESCRIPTION = 'Delete a role

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/roles/{roleId}

Deletes an existing custom role. System roles cannot be deleted. This operation will remove the role and all its associated policies.';
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
    protected const METHOD = 'delete';
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
