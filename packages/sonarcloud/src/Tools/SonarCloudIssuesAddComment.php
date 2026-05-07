<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Add a comment. Requires authentication and the following permission: 'Browse' on the project of the specified issue..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/issues/add_comment.
 */
class SonarCloudIssuesAddComment extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_add_comment';
    protected const DESCRIPTION = 'Add a comment. Requires authentication and the following permission: \'Browse\' on the project of the specified issue.

Official SonarCloud Web API endpoint: POST /api/issues/add_comment.';
    protected const PARAMETERS = array (
      'is_feedback' => array (
        'type' => 'string',
        'description' => 'Define is the given comment is a feedback',
        'required' => false,
      ),
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
      'isFeedback' => 'is_feedback',
      'issue' => 'issue',
      'text' => 'text',
    );
}
