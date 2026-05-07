<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Generate badge for project's quality gate as an SVG. Requires 'Browse' permission on the specified project..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/project_badges/quality_gate.
 */
class SonarQubeProjectBadgesQualityGate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_badges_quality_gate';
    protected const DESCRIPTION = 'Generate badge for project\'s quality gate as an SVG. Requires \'Browse\' permission on the specified project.

Official SonarQube Web API endpoint: GET /api/project_badges/quality_gate.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
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
    protected const PATH = '/api/project_badges/quality_gate';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
      'token' => 'token',
    );
}
