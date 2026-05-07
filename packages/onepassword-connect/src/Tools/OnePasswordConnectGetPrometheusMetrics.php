<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * See Prometheus documentation for a complete data model..
 *
 * Maps to the official 1Password Connect endpoint GET /metrics.
 */
class OnePasswordConnectGetPrometheusMetrics extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_prometheus_metrics';
    protected const DESCRIPTION = 'See Prometheus documentation for a complete data model.

Official 1Password Connect endpoint: GET /metrics.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/metrics';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
