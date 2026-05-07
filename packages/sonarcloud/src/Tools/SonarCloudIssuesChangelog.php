<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Display changelog of an issue. Requires the 'Browse' permission on the project of the specified issue..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/issues/changelog.
 */
class SonarCloudIssuesChangelog extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_changelog';
    protected const DESCRIPTION = 'Display changelog of an issue. Requires the \'Browse\' permission on the project of the specified issue.

Official SonarCloud Web API endpoint: GET /api/issues/changelog.';
    protected const PARAMETERS = array (
      'issue' => array (
        'type' => 'string',
        'description' => 'Issue key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/issues/changelog';
    protected const PARAM_MAP = array (
      'issue' => 'issue',
    );
}
