<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for tasks. Either componentId or component can be provided, but not both. Requires the project administration permission if componentId or component is set..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/ce/activity.
 */
class SonarCloudCeActivity extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_ce_activity';
    protected const DESCRIPTION = 'Search for tasks. Either componentId or component can be provided, but not both. Requires the project administration permission if componentId or component is set.

Official SonarCloud Web API endpoint: GET /api/ce/activity.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Key of the component (project) to filter on',
        'required' => false,
      ),
      'component_id' => array (
        'type' => 'string',
        'description' => 'Id of the component (project) to filter on',
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
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 1000',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to: - component names that contain the supplied string; - component keys that are exactly the same as the supplied string; - task ids that are exactly the same as the supplied string; Must not be set together with componentId',
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
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/ce/activity';
    protected const PARAM_MAP = array (
      'component' => 'component',
      'componentId' => 'component_id',
      'maxExecutedAt' => 'max_executed_at',
      'minSubmittedAt' => 'min_submitted_at',
      'onlyCurrents' => 'only_currents',
      'ps' => 'ps',
      'q' => 'q',
      'status' => 'status',
      'type' => 'type',
    );
}
