<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Allow to set a new main branch. . Caution, only applicable on projects. Requires 'Administer' rights on the specified project or application..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_branches/set_main.
 */
class SonarQubeProjectBranchesSetMain extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_branches_set_main';
    protected const DESCRIPTION = 'Allow to set a new main branch. . Caution, only applicable on projects. Requires \'Administer\' rights on the specified project or application.

Official SonarQube Web API endpoint: POST /api/project_branches/set_main.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_branches/set_main';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
    );
}
