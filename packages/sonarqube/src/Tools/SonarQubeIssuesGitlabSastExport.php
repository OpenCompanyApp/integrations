<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Return a list of vulnerabilities according to the Gitlab SAST JSON format. The JSON produced can be used in GitLab for generating the Vulnerability Report.Requires the 'Browse' or 'Scan' permission on the specified project..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/issues/gitlab_sast_export.
 */
class SonarQubeIssuesGitlabSastExport extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_gitlab_sast_export';
    protected const DESCRIPTION = 'Return a list of vulnerabilities according to the Gitlab SAST JSON format. The JSON produced can be used in GitLab for generating the Vulnerability Report.Requires the \'Browse\' or \'Scan\' permission on the specified project.

Official SonarQube Web API endpoint: GET /api/issues/gitlab_sast_export.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key.If this parameter is set, pullRequest must not be set.',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'The project key for which the vulnerabilities are being fetched',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id.If this parameter is set, branch must not be set.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/issues/gitlab_sast_export';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'projectKey' => 'project_key',
      'pullRequest' => 'pull_request',
    );
}
