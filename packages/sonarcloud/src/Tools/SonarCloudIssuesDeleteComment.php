<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a comment. Requires authentication and the following permission: 'Browse' on the project of the specified issue..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/issues/delete_comment.
 */
class SonarCloudIssuesDeleteComment extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_delete_comment';
    protected const DESCRIPTION = 'Delete a comment. Requires authentication and the following permission: \'Browse\' on the project of the specified issue.

Official SonarCloud Web API endpoint: POST /api/issues/delete_comment.';
    protected const PARAMETERS = array (
      'comment' => array (
        'type' => 'string',
        'description' => 'Comment key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/issues/delete_comment';
    protected const PARAM_MAP = array (
      'comment' => 'comment',
    );
}
