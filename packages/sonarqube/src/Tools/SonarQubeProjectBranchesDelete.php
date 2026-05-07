<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a non-main branch of a project or application. Requires 'Administer' rights on the specified project or application..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_branches/delete.
 */
class SonarQubeProjectBranchesDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_branches_delete';
    protected const DESCRIPTION = 'Delete a non-main branch of a project or application. Requires \'Administer\' rights on the specified project or application.

Official SonarQube Web API endpoint: POST /api/project_branches/delete.';
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
    protected const PATH = '/api/project_branches/delete';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'project' => 'project',
    );
}
