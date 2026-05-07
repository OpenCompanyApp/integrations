<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Generate badge for project's quality gate as an SVG. Requires a security token for private projects..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/project_badges/quality_gate.
 */
class SonarCloudProjectBadgesQualityGate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_badges_quality_gate';
    protected const DESCRIPTION = 'Generate badge for project\'s quality gate as an SVG. Requires a security token for private projects.

Official SonarCloud Web API endpoint: GET /api/project_badges/quality_gate.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Long-lived branch key',
        'required' => false,
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
    protected const PATH = '/api/project_badges/quality_gate';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
      'token' => 'token',
    );
}
