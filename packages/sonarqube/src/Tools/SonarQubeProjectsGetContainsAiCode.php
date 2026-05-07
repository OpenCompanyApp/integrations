<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get whether a project contains AI code or not.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/projects/get_contains_ai_code.
 */
class SonarQubeProjectsGetContainsAiCode extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_get_contains_ai_code';
    protected const DESCRIPTION = 'Get whether a project contains AI code or not

Official SonarQube Web API endpoint: GET /api/projects/get_contains_ai_code.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/projects/get_contains_ai_code';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
