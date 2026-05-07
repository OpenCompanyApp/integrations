<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Return monitoring metrics in Prometheus format. Support content type 'text/plain' (default) and 'application/openmetrics-text'. This endpoint can be accessed using a Bearer token, which needs to be defined in sonar.properties with the 'sonar.web.systemPasscode' key..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/monitoring/metrics.
 */
class SonarQubeMonitoringMetrics extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_monitoring_metrics';
    protected const DESCRIPTION = 'Return monitoring metrics in Prometheus format. Support content type \'text/plain\' (default) and \'application/openmetrics-text\'. This endpoint can be accessed using a Bearer token, which needs to be defined in sonar.properties with the \'sonar.web.systemPasscode\' key.

Official SonarQube Web API endpoint: GET /api/monitoring/metrics.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/monitoring/metrics';
    protected const PARAM_MAP = array (
);
}
