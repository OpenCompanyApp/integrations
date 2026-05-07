<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for tasks. Requires the system administration permission, or project administration permission if component is set..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/ce/activity.
 */
class SonarQubeCeActivity extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_ce_activity';
    protected const DESCRIPTION = 'Search for tasks. Requires the system administration permission, or project administration permission if component is set.

Official SonarQube Web API endpoint: GET /api/ce/activity.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Key of the component (project) to filter on',
        'required' => false,
      ),
      'max_executed_at' => array (
        'type' => 'string',
        'description' => 'Maximum date of end of task processing (inclusive)',
        'required' => false,
      ),
      'min_submitted_at' => array (
        'type' => 'string',
        'description' => 'Minimum date of task submission (inclusive)',
        'required' => false,
      ),
      'only_currents' => array (
        'type' => 'string',
        'description' => 'Filter on the last tasks (only the most recent finished task by project)',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 1000',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to: - component names that contain the supplied string; - component keys that are exactly the same as the supplied string; - task ids that are exactly the same as the supplied string;',
        'required' => false,
      ),
      'status' => array (
        'type' => 'string',
        'description' => 'Comma separated list of task statuses',
        'required' => false,
        'enum' => array (
          'SUCCESS',
          'FAILED',
          'CANCELED',
          'PENDING',
          'IN_PROGRESS',
        ),
      ),
      'type' => array (
        'type' => 'string',
        'description' => 'Task type',
        'required' => false,
        'enum' => array (
          'REPORT',
          'ISSUE_SYNC',
          'AUDIT_PURGE',
          'PROJECT_EXPORT',
          'APP_REFRESH',
          'SCA_RESCAN_BRANCH',
          'PROJECT_IMPORT',
          'VIEW_REFRESH',
          'REPORT_SUBMIT',
          'GITHUB_AUTH_PROVISIONING',
          'GITHUB_PROJECT_PERMISSIONS_PROVISIONING',
          'GITLAB_AUTH_PROVISIONING',
          'GITLAB_PROJECT_PERMISSIONS_PROVISIONING',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/ce/activity';
    protected const PARAM_MAP = array (
      'component' => 'component',
      'maxExecutedAt' => 'max_executed_at',
      'minSubmittedAt' => 'min_submitted_at',
      'onlyCurrents' => 'only_currents',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'status' => 'status',
      'type' => 'type',
    );
}
