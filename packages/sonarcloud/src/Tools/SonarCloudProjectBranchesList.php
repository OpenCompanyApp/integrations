<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List the branches of a project. The statistics are the overall counts on long branches, and the count of issues detected on the changed code on short branches, and are only provided if the project parameter is specified. If the project parameter is specified, requires the user to have 'Browse' or 'Execute analysis' rights on that project. Otherwise, only returns branches from projects on which this user has 'Browse' or 'Execute analysis' rights..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/project_branches/list.
 */
class SonarCloudProjectBranchesList extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_branches_list';
    protected const DESCRIPTION = 'List the branches of a project. The statistics are the overall counts on long branches, and the count of issues detected on the changed code on short branches, and are only provided if the project parameter is specified. If the project parameter is specified, requires the user to have \'Browse\' or \'Execute analysis\' rights on that project. Otherwise, only returns branches from projects on which this user has \'Browse\' or \'Execute analysis\' rights.

Official SonarCloud Web API endpoint: GET /api/project_branches/list.';
    protected const PARAMETERS = array (
      'branch_ids' => array (
        'type' => 'string',
        'description' => 'List of up to 50 branch IDs - required unless project key is provided',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key - required unless branchIds is provided',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_branches/list';
    protected const PARAM_MAP = array (
      'branchIds' => 'branch_ids',
      'project' => 'project',
    );
}
