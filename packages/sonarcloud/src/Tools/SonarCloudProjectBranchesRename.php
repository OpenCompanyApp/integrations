<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Rename the main branch of a project. Requires 'Administer' permission on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_branches/rename.
 */
class SonarCloudProjectBranchesRename extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_branches_rename';
    protected const DESCRIPTION = 'Rename the main branch of a project. Requires \'Administer\' permission on the specified project.

Official SonarCloud Web API endpoint: POST /api/project_branches/rename.';
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
