<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List the branches of a project or application. Requires 'Browse' or 'Execute analysis' rights on the specified project or application..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/project_branches/list.
 */
class SonarQubeProjectBranchesList extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_branches_list';
    protected const DESCRIPTION = 'List the branches of a project or application. Requires \'Browse\' or \'Execute analysis\' rights on the specified project or application.

Official SonarQube Web API endpoint: GET /api/project_branches/list.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_branches/list';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
