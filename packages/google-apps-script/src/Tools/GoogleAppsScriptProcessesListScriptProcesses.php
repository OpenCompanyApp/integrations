<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Processes List Script Processes.
 *
 * Maps to the official Apps Script endpoint GET /v1/processes:listScriptProcesses.
 */
class GoogleAppsScriptProcessesListScriptProcesses extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_processes_list_script_processes';
    protected const DESCRIPTION = 'Processes List Script Processes

Official Apps Script endpoint: GET /v1/processes:listScriptProcesses
List information about a script\'s executed processes, such as process type and current status.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Apps Script method. Known keys: scriptProcessFilter.startTime, scriptProcessFilter.statuses, scriptId, pageToken, scriptProcessFilter.deploymentId, scriptProcessFilter.types, scriptProcessFilter.userAccessLevels, pageSize, scriptProcessFilter.endTime, scriptProcessFilter.functionName.',
  ),
  'scriptProcessFilter.startTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptProcessFilter.startTime`.',
  ),
  'scriptProcessFilter.statuses' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptProcessFilter.statuses`.',
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
  'scriptId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptId`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'scriptProcessFilter.deploymentId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptProcessFilter.deploymentId`.',
  ),
  'scriptProcessFilter.types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptProcessFilter.types`.',
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
  'scriptProcessFilter.userAccessLevels' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptProcessFilter.userAccessLevels`.',
    'enum' =>
    array (
      0 => 'USER_ACCESS_LEVEL_UNSPECIFIED',
      1 => 'NONE',
      2 => 'READ',
      3 => 'WRITE',
      4 => 'OWNER',
    ),
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'scriptProcessFilter.endTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptProcessFilter.endTime`.',
  ),
  'scriptProcessFilter.functionName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `scriptProcessFilter.functionName`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/processes:listScriptProcesses';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'scriptProcessFilter.startTime',
  1 => 'scriptProcessFilter.statuses',
  2 => 'scriptId',
  3 => 'pageToken',
  4 => 'scriptProcessFilter.deploymentId',
  5 => 'scriptProcessFilter.types',
  6 => 'scriptProcessFilter.userAccessLevels',
  7 => 'pageSize',
  8 => 'scriptProcessFilter.endTime',
  9 => 'scriptProcessFilter.functionName',
);
    protected const BODY_REQUIRED = false;
}
