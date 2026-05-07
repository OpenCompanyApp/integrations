<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Edit a comment. Requires authentication and the following permission: 'Browse' on the project of the specified issue..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/issues/edit_comment.
 */
class SonarQubeIssuesEditComment extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_edit_comment';
    protected const DESCRIPTION = 'Edit a comment. Requires authentication and the following permission: \'Browse\' on the project of the specified issue.

Official SonarQube Web API endpoint: POST /api/issues/edit_comment.';
    protected const PARAMETERS = array (
      'comment' => array (
        'type' => 'string',
        'description' => 'Comment key',
        'required' => true,
      ),
      'text' => array (
        'type' => 'string',
        'description' => 'Comment text',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/edit_comment';
    protected const PARAM_MAP = array (
      'comment' => 'comment',
      'text' => 'text',
    );
}
