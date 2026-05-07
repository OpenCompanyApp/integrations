<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Generate badge for project's measure as an SVG. Requires 'Browse' permission on the specified project..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/project_badges/measure.
 */
class SonarQubeProjectBadgesMeasure extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_badges_measure';
    protected const DESCRIPTION = 'Generate badge for project\'s measure as an SVG. Requires \'Browse\' permission on the specified project.

Official SonarQube Web API endpoint: GET /api/project_badges/measure.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'metric' => array (
        'type' => 'string',
        'description' => 'Metric key',
        'required' => true,
        'enum' => array (
          'coverage',
          'duplicated_lines_density',
          'ncloc',
          'alert_status',
          'security_hotspots',
          'bugs',
          'code_smells',
          'vulnerabilities',
          'sqale_rating',
          'reliability_rating',
          'security_rating',
          'sqale_index',
          'software_quality_reliability_issues',
          'software_quality_maintainability_issues',
          'software_quality_security_issues',
          'software_quality_maintainability_rating',
          'software_quality_reliability_rating',
          'software_quality_security_rating',
          'software_quality_maintainability_remediation_effort',
        ),
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project or application key',
        'required' => true,
      ),
      'token' => array (
        'type' => 'string',
        'description' => 'Project badge token. Required for private projects or if the \'sonar.forceAuthentication\' setting is enabled.',
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
