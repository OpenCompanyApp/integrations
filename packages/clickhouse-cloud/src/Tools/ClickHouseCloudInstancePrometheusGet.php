<?php

namespace OpenCompany\Integrations\ClickHouseCloud\Tools;

/**
 * Get service metrics.
 *
 * Maps to the official ClickHouse Cloud endpoint get /v1/organizations/{organizationId}/services/{serviceId}/prometheus.
 */
class ClickHouseCloudInstancePrometheusGet extends AbstractClickHouseCloudTool
{
    protected const NAME = 'clickhouse_cloud_instance_prometheus_get';
    protected const DESCRIPTION = 'Get service metrics

Official ClickHouse Cloud endpoint: GET /v1/organizations/{organizationId}/services/{serviceId}/prometheus

Returns prometheus metrics for a service.';
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
    'description' => 'ID of the requested service.',
    'required' => true,
  ),
  'filtered_metrics' =>
  array (
    'type' => 'string',
    'description' => 'Return a filtered list of Prometheus metrics.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/organizations/{organizationId}/services/{serviceId}/prometheus';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'serviceId' => 'service_id',
);
    protected const QUERY_PARAMS = array (
  'filtered_metrics' => 'filtered_metrics',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
