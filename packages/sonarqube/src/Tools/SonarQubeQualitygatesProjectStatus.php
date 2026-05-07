<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the quality gate status of a project or a Compute Engine task. Either 'analysisId', 'projectId' or 'projectKey' must be provided The different statuses returned are: OK, WARN, ERROR, NONE. The NONE status is returned when there is no quality gate associated with the analysis. Returns an HTTP code 404 if the analysis associated with the task is not found or does not exist. Requires one of the following permissions:- 'Administer System'; - 'Administer' rights on the specified project; - 'Browse' on the specified project; - 'Execute Analysis' on the specified project;.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/qualitygates/project_status.
 */
class SonarQubeQualitygatesProjectStatus extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_qualitygates_project_status';
    protected const DESCRIPTION = 'Get the quality gate status of a project or a Compute Engine task. Either \'analysisId\', \'projectId\' or \'projectKey\' must be provided The different statuses returned are: OK, WARN, ERROR, NONE. The NONE status is returned when there is no quality gate associated with the analysis. Returns an HTTP code 404 if the analysis associated with the task is not found or does not exist. Requires one of the following permissions:- \'Administer System\'; - \'Administer\' rights on the specified project; - \'Browse\' on the specified project; - \'Execute Analysis\' on the specified project;

Official SonarQube Web API endpoint: GET /api/qualitygates/project_status.';
    protected const PARAMETERS = array (
      'analysis_id' => array (
        'type' => 'string',
        'description' => 'Analysis id',
        'required' => false,
      ),
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'Project UUID. Doesn\'t work with branches or pull requests',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/qualitygates/project_status';
    protected const PARAM_MAP = array (
      'analysisId' => 'analysis_id',
      'branch' => 'branch',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
      'pullRequest' => 'pull_request',
    );
}
