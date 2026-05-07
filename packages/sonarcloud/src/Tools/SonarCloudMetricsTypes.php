<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List all available metric types..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/metrics/types.
 */
class SonarCloudMetricsTypes extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_metrics_types';
    protected const DESCRIPTION = 'List all available metric types.

Official SonarCloud Web API endpoint: GET /api/metrics/types.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/metrics/types';
    protected const PARAM_MAP = array (
);
}
