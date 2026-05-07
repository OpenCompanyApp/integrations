<?php

namespace OpenCompany\Integrations\GoogleAdminReports\Tools;

/**
 * User Usage Report Get.
 *
 * Maps to the official Admin Reports endpoint GET /admin/reports/v1/usage/users/{userKey}/dates/{date}.
 */
class GoogleAdminReportsUserUsageReportGet extends AbstractGoogleAdminReportsTool
{
    protected const NAME = 'google_admin_reports_user_usage_report_get';
    protected const DESCRIPTION = 'User Usage Report Get

Official Admin Reports endpoint: GET /admin/reports/v1/usage/users/{userKey}/dates/{date}
Retrieves a report which is a collection of properties and statistics for a set of users with the account.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Use Reports API identifiers such as userKey, applicationName, date, entityType, or entityKey.',
  ),
  'date' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `date`. Use Reports API identifiers such as userKey, applicationName, date, entityType, or entityKey.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Admin Reports method. Known keys: parameters, orgUnitID, pageToken, customerId, maxResults, filters, groupIdFilter.',
  ),
  'parameters' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parameters`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/reports/v1/usage/users/{userKey}/dates/{date}';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
  1 => 'date',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'parameters',
  1 => 'orgUnitID',
  2 => 'pageToken',
  3 => 'customerId',
  4 => 'maxResults',
  5 => 'filters',
  6 => 'groupIdFilter',
);
    protected const BODY_REQUIRED = false;
}
