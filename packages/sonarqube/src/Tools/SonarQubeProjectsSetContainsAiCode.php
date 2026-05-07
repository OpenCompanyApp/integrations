<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Sets if the project passed as parameter contains or not AI code according to the value of the contains_ai_code parameter. Requires 'Administer' rights on the specified project..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/projects/set_contains_ai_code.
 */
class SonarQubeProjectsSetContainsAiCode extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_set_contains_ai_code';
    protected const DESCRIPTION = 'Sets if the project passed as parameter contains or not AI code according to the value of the contains_ai_code parameter. Requires \'Administer\' rights on the specified project.

Official SonarQube Web API endpoint: POST /api/projects/set_contains_ai_code.';
    protected const PARAMETERS = array (
      'contains_ai_code' => array (
        'type' => 'string',
        'description' => 'Flag to set whether the project contains AI code or not.',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/set_contains_ai_code';
    protected const PARAM_MAP = array (
      'contains_ai_code' => 'contains_ai_code',
      'project' => 'project',
    );
}
