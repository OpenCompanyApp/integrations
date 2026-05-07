<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Assign/Unassign an issue. Requires authentication and Browse permission on project.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/issues/assign.
 */
class SonarCloudIssuesAssign extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_assign';
    protected const DESCRIPTION = 'Assign/Unassign an issue. Requires authentication and Browse permission on project

Official SonarCloud Web API endpoint: POST /api/issues/assign.';
    protected const PARAMETERS = array (
      'assignee' => array (
        'type' => 'string',
        'description' => 'Login of the assignee. When not set, it will unassign the issue. Use \'_me\' to assign to current user',
        'required' => false,
      ),
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/assign';
    protected const PARAM_MAP = array (
      'assignee' => 'assignee',
      'issue' => 'issue',
    );
}
