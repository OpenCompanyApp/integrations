<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List all available metric types..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/metrics/types.
 */
class SonarQubeMetricsTypes extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_metrics_types';
    protected const DESCRIPTION = 'List all available metric types.

Official SonarQube Web API endpoint: GET /api/metrics/types.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/metrics/types';
    protected const PARAM_MAP = array (
);
}
