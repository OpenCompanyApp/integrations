<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Generate a badge for project's AI assurance as an SVG. Requires 'Browse' permission on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/project_badges/ai_code_assurance.
 */
class SonarCloudProjectBadgesAiCodeAssurance extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_badges_ai_code_assurance';
    protected const DESCRIPTION = 'Generate a badge for project\'s AI assurance as an SVG. Requires \'Browse\' permission on the specified project.

Official SonarCloud Web API endpoint: GET /api/project_badges/ai_code_assurance.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/project_badges/ai_code_assurance';
    protected const PARAM_MAP = array (
      'project' => 'project',
      'token' => 'token',
    );
}
