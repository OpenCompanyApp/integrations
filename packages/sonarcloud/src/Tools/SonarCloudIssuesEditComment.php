<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Edit a comment. Requires authentication and the following permission: 'Browse' on the project of the specified issue..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/issues/edit_comment.
 */
class SonarCloudIssuesEditComment extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_edit_comment';
    protected const DESCRIPTION = 'Edit a comment. Requires authentication and the following permission: \'Browse\' on the project of the specified issue.

Official SonarCloud Web API endpoint: POST /api/issues/edit_comment.';
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
