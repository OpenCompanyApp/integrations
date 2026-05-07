<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Generate a badge for project's AI assurance as an SVG. Requires 'Browse' permission on the specified project..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/project_badges/ai_code_assurance.
 */
class SonarQubeProjectBadgesAiCodeAssurance extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_badges_ai_code_assurance';
    protected const DESCRIPTION = 'Generate a badge for project\'s AI assurance as an SVG. Requires \'Browse\' permission on the specified project.

Official SonarQube Web API endpoint: GET /api/project_badges/ai_code_assurance.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/project_badges/ai_code_assurance';
    protected const PARAM_MAP = array (
      'project' => 'project',
      'token' => 'token',
    );
}
