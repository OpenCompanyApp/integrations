<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Create BYOC Infrastructure.
 *
 * Maps to the official ClickHouse Cloud endpoint post /v1/organizations/{organizationId}/byocInfrastructure.
 */
class ClickHouseCloudOrganizationByocInfrastructureCreate extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_byoc_infrastructure_create';
    protected const DESCRIPTION = 'Create BYOC Infrastructure

Official ClickHouse Cloud endpoint: POST /v1/organizations/{organizationId}/byocInfrastructure

Create a new BYOC Infrastructure in the organization. Returns the configuration of the newly created infrastructure';
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
    protected const PATH = '/v1/organizations/{organizationId}/byocInfrastructure';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
