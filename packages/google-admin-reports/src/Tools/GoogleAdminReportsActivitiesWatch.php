<?php

namespace OpenCompany\Integrations\GoogleAdminReports\Tools;

/**
 * Activities Watch.
 *
 * Maps to the official Admin Reports endpoint POST /admin/reports/v1/activity/users/{userKey}/applications/{applicationName}/watch.
 */
class GoogleAdminReportsActivitiesWatch extends AbstractGoogleAdminReportsTool
{
    protected const NAME = 'google_admin_reports_activities_watch';
    protected const DESCRIPTION = 'Activities Watch

Official Admin Reports endpoint: POST /admin/reports/v1/activity/users/{userKey}/applications/{applicationName}/watch
Start receiving notifications for account activities.';
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
    'description' => 'Query string parameters accepted by the official Admin Reports method. Known keys: groupIdFilter, filters, endTime, eventName, customerId, maxResults, actorIpAddress, orgUnitID, pageToken, startTime.',
  ),
  'groupIdFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `groupIdFilter`.',
  ),
  'filters' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filters`.',
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
  'customerId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `customerId`.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Admin Reports `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/reports/v1/activity/users/{userKey}/applications/{applicationName}/watch';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
  1 => 'applicationName',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'groupIdFilter',
  1 => 'filters',
  2 => 'endTime',
  3 => 'eventName',
  4 => 'customerId',
  5 => 'maxResults',
  6 => 'actorIpAddress',
  7 => 'orgUnitID',
  8 => 'pageToken',
  9 => 'startTime',
);
    protected const BODY_REQUIRED = true;
}
