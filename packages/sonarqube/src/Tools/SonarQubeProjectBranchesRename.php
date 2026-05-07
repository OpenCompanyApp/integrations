<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Rename the main branch of a project or application. Requires 'Administer' permission on the specified project or application..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_branches/rename.
 */
class SonarQubeProjectBranchesRename extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_branches_rename';
    protected const DESCRIPTION = 'Rename the main branch of a project or application. Requires \'Administer\' permission on the specified project or application.

Official SonarQube Web API endpoint: POST /api/project_branches/rename.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'New name of the main branch',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_branches/rename';
    protected const PARAM_MAP = array (
      'name' => 'name',
      'project' => 'project',
    );
}
