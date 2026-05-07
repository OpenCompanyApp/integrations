<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

/**
 * Get the Prometheus Metric Export configuration for a cluster.
 *
 * Generated from the official CockroachDB Cloud OpenAPI operation CockroachCloud_GetPrometheusMetricExportInfo.
 */
class CockroachDbGetPrometheusMetricExportInfo extends AbstractCockroachDbOperationTool
{
    protected const TOOL_NAME = 'cockroachdb_get_prometheus_metric_export_info';
}