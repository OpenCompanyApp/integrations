<?php

namespace OpenCompany\Integrations\GoogleAdminReports\Tools;

/**
 * Activities List.
 *
 * Maps to the official Admin Reports endpoint GET /admin/reports/v1/activity/users/{userKey}/applications/{applicationName}.
 */
class GoogleAdminReportsActivitiesList extends AbstractGoogleAdminReportsTool
{
    protected const NAME = 'google_admin_reports_activities_list';
    protected const DESCRIPTION = 'Activities List

Official Admin Reports endpoint: GET /admin/reports/v1/activity/users/{userKey}/applications/{applicationName}
Retrieves a list of activities for a specific customer\'s account and application such as the Admin console application or the Google Drive application.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Use Reports API identifiers such as userKey, applicationName, date, entityType, or entityKey.',
  ),
  'applicationName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `applicationName`. Use Reports API identifiers such as userKey, applicationName, date, entityType, or entityKey.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Admin Reports method. Known keys: statusFilter, endTime, eventName, actorIpAddress, orgUnitID, maxResults, includeSensitiveData, filters, groupIdFilter, networkInfoFilter, pageToken, startTime, applicationInfoFilter, customerId, resourceDetailsFilter.',
  ),
  'statusFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `statusFilter`.',
  ),
  'endTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `endTime`.',
  ),
  'eventName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `eventName`.',
  ),
  'actorIpAddress' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `actorIpAddress`.',
  ),
  'orgUnitID' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orgUnitID`.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'includeSensitiveData' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `includeSensitiveData`.',
  ),
  'filters' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filters`.',
  ),
  'groupIdFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `groupIdFilter`.',
  ),
  'networkInfoFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `networkInfoFilter`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'startTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `startTime`.',
  ),
  'applicationInfoFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `applicationInfoFilter`.',
  ),
  'customerId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `customerId`.',
  ),
  'resourceDetailsFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `resourceDetailsFilter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/reports/v1/activity/users/{userKey}/applications/{applicationName}';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
  1 => 'applicationName',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'statusFilter',
  1 => 'endTime',
  2 => 'eventName',
  3 => 'actorIpAddress',
  4 => 'orgUnitID',
  5 => 'maxResults',
  6 => 'includeSensitiveData',
  7 => 'filters',
  8 => 'groupIdFilter',
  9 => 'networkInfoFilter',
  10 => 'pageToken',
  11 => 'startTime',
  12 => 'applicationInfoFilter',
  13 => 'customerId',
  14 => 'resourceDetailsFilter',
);
    protected const BODY_REQUIRED = false;
}
