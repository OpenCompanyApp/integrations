<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Display changelog of an issue. Requires the 'Browse' permission on the project of the specified issue..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/issues/changelog.
 */
class SonarQubeIssuesChangelog extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_changelog';
    protected const DESCRIPTION = 'Display changelog of an issue. Requires the \'Browse\' permission on the project of the specified issue.

Official SonarQube Web API endpoint: GET /api/issues/changelog.';
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
