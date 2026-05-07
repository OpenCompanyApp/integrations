<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for metrics.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/metrics/search.
 */
class SonarCloudMetricsSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_metrics_search';
    protected const DESCRIPTION = 'Search for metrics

Official SonarCloud Web API endpoint: GET /api/metrics/search.';
    protected const PARAMETERS = array (
      'f' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of the fields to be returned in response. All the fields are returned by default.',
        'required' => false,
        'enum' => array (
          'name',
          'description',
          'domain',
          'direction',
          'qualitative',
          'hidden',
          'decimalScale',
        ),
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/metrics/search';
    protected const PARAM_MAP = array (
      'f' => 'f',
      'p' => 'p',
      'ps' => 'ps',
    );
}
