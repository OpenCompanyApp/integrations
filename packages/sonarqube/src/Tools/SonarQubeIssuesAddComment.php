<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a comment. Requires authentication and the following permission: 'Browse' on the project of the specified issue..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/issues/add_comment.
 */
class SonarQubeIssuesAddComment extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_add_comment';
    protected const DESCRIPTION = 'Add a comment. Requires authentication and the following permission: \'Browse\' on the project of the specified issue.

Official SonarQube Web API endpoint: POST /api/issues/add_comment.';
    protected const PARAMETERS = array (
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
      'text' => array (
        'type' => 'string',
        'description' => 'Comment text',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/add_comment';
    protected const PARAM_MAP = array (
      'issue' => 'issue',
      'text' => 'text',
    );
}
