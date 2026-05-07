<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get organization usage costs.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/usageCost.
 */
class ClickHouseCloudUsageCostGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_usage_cost_get';
    protected const DESCRIPTION = 'Get organization usage costs

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/usageCost

Returns a grand total and a list of daily, per-entity organization usage cost records for the organization in the queried time period (maximum 31 days). All days in both the request and the response are evaluated based on the UTC timezone.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'from_date' =>
  array (
    'type' => 'string',
    'description' => 'Start date for the report, e.g. 2024-12-19.',
    'required' => true,
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'description' => 'End date (inclusive) for the report, e.g. 2024-12-20. This date cannot be more than 30 days after from_date (for a maximum queried period of 31 days).',
    'required' => true,
  ),
  'filter' =>
  array (
    'type' => 'array',
    'description' => 'Filter criteria to apply when retrieving the usage cost report. Currently, only filtering by resource tags is supported.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/usageCost';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'filter' => 'filter',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
