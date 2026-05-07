<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List all custom metric domains..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/metrics/domains.
 */
class SonarCloudMetricsDomains extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_metrics_domains';
    protected const DESCRIPTION = 'List all custom metric domains.

Official SonarCloud Web API endpoint: GET /api/metrics/domains.

Deprecated since SonarCloud 7.7; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/metrics/domains';
    protected const PARAM_MAP = array (
);
}
