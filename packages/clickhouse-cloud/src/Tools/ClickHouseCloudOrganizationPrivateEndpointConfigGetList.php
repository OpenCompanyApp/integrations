<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get private endpoint configuration for region within cloud provider for an organization.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/privateEndpointConfig.
 */
class ClickHouseCloudOrganizationPrivateEndpointConfigGetList extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_private_endpoint_config_get_list';
    protected const DESCRIPTION = 'Get private endpoint configuration for region within cloud provider for an organization

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/privateEndpointConfig

Deprecated. Please follow [documentation](https://clickhouse.com/docs/manage/security/aws-privatelink#add-endpoint-id-to-services-allow-list) for the updated process.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'cloud_provider' =>
  array (
    'type' => 'string',
    'description' => 'Cloud provider identifier. One of aws, gcp, or azure.',
    'required' => true,
  ),
  'region_id' =>
  array (
    'type' => 'string',
    'description' => 'Region identifier within specific cloud providers.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/privateEndpointConfig';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
  'cloud_provider' => 'cloud_provider',
  'region_id' => 'region_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
