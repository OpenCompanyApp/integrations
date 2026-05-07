<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get organization metrics.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/prometheus.
 */
class ClickHouseCloudOrganizationPrometheusGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_organization_prometheus_get';
    protected const DESCRIPTION = 'Get organization metrics

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/prometheus

Returns prometheus metrics for all services in an organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the requested organization.',
    'required' => true,
  ),
  'filtered_metrics' =>
  array (
    'type' => 'string',
    'description' => 'Return a filtered list of Prometheus metrics.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/prometheus';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
  'filtered_metrics' => 'filtered_metrics',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
