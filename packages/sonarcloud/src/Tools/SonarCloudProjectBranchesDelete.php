<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a non-main branch of a project. Requires 'Administer' rights on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_branches/delete.
 */
class SonarCloudProjectBranchesDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_branches_delete';
    protected const DESCRIPTION = 'Delete a non-main branch of a project. Requires \'Administer\' rights on the specified project.

Official SonarCloud Web API endpoint: POST /api/project_branches/delete.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Name of the branch',
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
