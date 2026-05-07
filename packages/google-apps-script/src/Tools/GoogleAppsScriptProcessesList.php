<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Processes List.
 *
 * Maps to the official Apps Script endpoint GET /v1/processes.
 */
class GoogleAppsScriptProcessesList extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_processes_list';
    protected const DESCRIPTION = 'Processes List

Official Apps Script endpoint: GET /v1/processes
List information about processes made by or on behalf of a user, such as process type and current status.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Apps Script method. Known keys: userProcessFilter.deploymentId, userProcessFilter.types, userProcessFilter.scriptId, userProcessFilter.functionName, userProcessFilter.endTime, userProcessFilter.statuses, pageSize, userProcessFilter.projectName, userProcessFilter.startTime, userProcessFilter.userAccessLevels, pageToken.',
  ),
  'userProcessFilter.deploymentId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.deploymentId`.',
  ),
  'userProcessFilter.types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.types`.',
    'enum' =>
    array (
      0 => 'PROCESS_TYPE_UNSPECIFIED',
      1 => 'ADD_ON',
      2 => 'EXECUTION_API',
      3 => 'TIME_DRIVEN',
      4 => 'TRIGGER',
      5 => 'WEBAPP',
      6 => 'EDITOR',
      7 => 'SIMPLE_TRIGGER',
      8 => 'MENU',
      9 => 'BATCH_TASK',
    ),
  ),
  'userProcessFilter.scriptId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.scriptId`.',
  ),
  'userProcessFilter.functionName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.functionName`.',
  ),
  'userProcessFilter.endTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.endTime`.',
  ),
  'userProcessFilter.statuses' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.statuses`.',
    'enum' =>
    array (
      0 => 'PROCESS_STATUS_UNSPECIFIED',
      1 => 'RUNNING',
      2 => 'PAUSED',
      3 => 'COMPLETED',
      4 => 'CANCELED',
      5 => 'FAILED',
      6 => 'TIMED_OUT',
      7 => 'UNKNOWN',
      8 => 'DELAYED',
      9 => 'EXECUTION_DISABLED',
    ),
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'userProcessFilter.projectName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.projectName`.',
  ),
  'userProcessFilter.startTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.startTime`.',
  ),
  'userProcessFilter.userAccessLevels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userProcessFilter.userAccessLevels`.',
    'enum' =>
    array (
      0 => 'USER_ACCESS_LEVEL_UNSPECIFIED',
      1 => 'NONE',
      2 => 'READ',
      3 => 'WRITE',
      4 => 'OWNER',
    ),
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/processes';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'userProcessFilter.deploymentId',
  1 => 'userProcessFilter.types',
  2 => 'userProcessFilter.scriptId',
  3 => 'userProcessFilter.functionName',
  4 => 'userProcessFilter.endTime',
  5 => 'userProcessFilter.statuses',
  6 => 'pageSize',
  7 => 'userProcessFilter.projectName',
  8 => 'userProcessFilter.startTime',
  9 => 'userProcessFilter.userAccessLevels',
  10 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
