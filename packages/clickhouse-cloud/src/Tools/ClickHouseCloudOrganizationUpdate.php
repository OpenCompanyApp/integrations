<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update organization details.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}.
 */
class ClickHouseCloudOrganizationUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_update';
    protected const DESCRIPTION = 'Update organization details

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}

Updates organization fields. Requires ADMIN auth key role.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization to update.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/organizations/{organizationId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
