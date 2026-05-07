<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * ClickStack: Get Dashboard.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/clickstack/dashboards/{clickStackDashboardId}.
 */
class ClickHouseCloudClickStackGetDashboard extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_click_stack_get_dashboard';
    protected const DESCRIPTION = 'ClickStack: Get Dashboard

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/clickstack/dashboards/{clickStackDashboardId}

**This endpoint is in beta.** API contract is stable, and no breaking changes are expected in the future.  ClickStack: Retrieves a specific dashboard by ID';
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
  'click_stack_dashboard_id' =>
  array (
    'type' => 'string',
    'description' => 'ClickStack Dashboard ID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/clickstack/dashboards/{clickStackDashboardId}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
  'clickStackDashboardId' => 'click_stack_dashboard_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
