<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Generate badge for project's measure as an SVG. Requires a security token for private projects..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/project_badges/measure.
 */
class SonarCloudProjectBadgesMeasure extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_badges_measure';
    protected const DESCRIPTION = 'Generate badge for project\'s measure as an SVG. Requires a security token for private projects.

Official SonarCloud Web API endpoint: GET /api/project_badges/measure.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Long-lived branch key',
        'required' => false,
      ),
      'metric' => array (
        'type' => 'string',
        'description' => 'Metric key',
        'required' => true,
        'enum' => array (
          'coverage',
          'ncloc',
          'code_smells',
          'sqale_rating',
          'security_rating',
          'bugs',
          'vulnerabilities',
          'duplicated_lines_density',
          'reliability_rating',
          'alert_status',
          'sqale_index',
        ),
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project or application key',
        'required' => true,
      ),
      'token' => array (
        'type' => 'string',
        'description' => 'Security token',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_badges/measure';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'metric' => 'metric',
      'project' => 'project',
      'token' => 'token',
    );
}
