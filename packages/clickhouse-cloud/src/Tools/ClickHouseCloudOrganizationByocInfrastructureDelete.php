<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Remove a BYOC infrastructure.
 *
 * Maps to the official ClickHouse Cloud endpoint delete /v1/organizations/{organizationId}/byocInfrastructure/{byocInfrastructureId}.
 */
class ClickHouseCloudOrganizationByocInfrastructureDelete extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_byoc_infrastructure_delete';
    protected const DESCRIPTION = 'Remove a BYOC infrastructure

Official ClickHouse Cloud endpoint: DELETE /v1/organizations/{organizationId}/byocInfrastructure/{byocInfrastructureId}

Removes a BYOC Infrastructure from the organization';
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
);
    protected const METHOD = 'delete';
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
