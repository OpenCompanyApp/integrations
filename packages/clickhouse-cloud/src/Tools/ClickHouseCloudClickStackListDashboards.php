<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * ClickStack: List Dashboards.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickstack/dashboards.
 */
class ClickHouseCloudClickStackListDashboards extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_stack_list_dashboards';
    protected const DESCRIPTION = 'ClickStack: List Dashboards

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickstack/dashboards

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  ClickStack: Retrieves a list of all dashboards for the authenticated team';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the organization that owns the service.',
    'required' => true,
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the ClickStack service.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickstack/dashboards';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
