<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Update BYOC Infrastructure.
 *
 * Maps to the official ClickHouse Cloud endpoint patch /v1/organizations/{organizationId}/byocInfrastructure/{byocInfrastructureId}.
 */
class ClickHouseCloudOrganizationByocInfrastructureUpdate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_byoc_infrastructure_update';
    protected const DESCRIPTION = 'Update BYOC Infrastructure

Official ClickHouse Cloud endpoint: PATCH /v1/organizations/{organizationId}/byocInfrastructure/{byocInfrastructureId}

Update configuration of the BYOC infrastructure. Returns the modified infrastructure';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'byoc_infrastructure_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested BYOC Infrastructure',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the ClickHouse Cloud API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/organizations/{organizationId}/byocInfrastructure/{byocInfrastructureId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'byocInfrastructureId' => 'byoc_infrastructure_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
