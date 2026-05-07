<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Return component with specified measures. Requires one of the following permissions:- 'Browse' on the project of the specified component; - 'Execute Analysis' on the project of the specified component;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/measures/component.
 */
class SonarQubeMeasuresComponent extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_measures_component';
    protected const DESCRIPTION = 'Return component with specified measures. Requires one of the following permissions:- \'Browse\' on the project of the specified component; - \'Execute Analysis\' on the project of the specified component;

Official SonarQube Web API endpoint: GET /api/measures/component.';
    protected const PARAMETERS = array (
      'additional_fields' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of additional fields that can be returned in the response.',
        'required' => false,
        'enum' => array (
          'metrics',
          'period',
        ),
      ),
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key. Not available in the community edition.',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => true,
      ),
      'metric_keys' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of metric keys',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id. Not available in the community edition.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/measures/component';
    protected const PARAM_MAP = array (
      'additionalFields' => 'additional_fields',
      'branch' => 'branch',
      'component' => 'component',
      'metricKeys' => 'metric_keys',
      'pullRequest' => 'pull_request',
    );
}
