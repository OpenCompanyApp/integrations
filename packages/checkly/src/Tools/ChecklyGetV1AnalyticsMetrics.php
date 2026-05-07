<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * List all available reporting metrics..
 *
 * Maps to the official Checkly endpoint GET /v1/analytics/metrics.
 */
class ChecklyGetV1AnalyticsMetrics extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_analytics_metrics';
    protected const DESCRIPTION = 'List all available reporting metrics.

Official Checkly endpoint: GET /v1/analytics/metrics.';
    protected const PARAMETERS = array (
      'check_type' => array (
        'type' => 'string',
        'description' => 'checkType parameter.',
        'required' => true,
        'enum' => array (
          'AGENTIC',
          'API',
          'BROWSER',
          'HEARTBEAT',
          'ICMP',
          'MULTI_STEP',
          'TCP',
          'PLAYWRIGHT',
          'URL',
          'DNS',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/analytics/metrics';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'checkType' => 'check_type',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
