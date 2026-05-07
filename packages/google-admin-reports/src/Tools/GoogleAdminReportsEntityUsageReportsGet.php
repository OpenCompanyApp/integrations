<?php

namespace OpenCompany\Integrations\GoogleAdminReports\Tools;

/**
 * Entity Usage Reports Get.
 *
 * Maps to the official Admin Reports endpoint GET /admin/reports/v1/usage/{entityType}/{entityKey}/dates/{date}.
 */
class GoogleAdminReportsEntityUsageReportsGet extends AbstractGoogleAdminReportsTool
{
    protected const NAME = 'google_admin_reports_entity_usage_reports_get';
    protected const DESCRIPTION = 'Entity Usage Reports Get

Official Admin Reports endpoint: GET /admin/reports/v1/usage/{entityType}/{entityKey}/dates/{date}
Retrieves a report which is a collection of properties and statistics for entities used by users within the account.';
    protected const PARAMETERS = array (
  'entityType' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entityType`. Use Reports API identifiers such as userKey, applicationName, date, entityType, or entityKey.',
  ),
  'entityKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entityKey`. Use Reports API identifiers such as userKey, applicationName, date, entityType, or entityKey.',
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
    'description' => 'Query string parameters accepted by the official Admin Reports method. Known keys: filters, parameters, pageToken, customerId, maxResults.',
  ),
  'filters' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filters`.',
  ),
  'parameters' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parameters`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/reports/v1/usage/{entityType}/{entityKey}/dates/{date}';
    protected const PATH_PARAMS = array (
  0 => 'entityType',
  1 => 'entityKey',
  2 => 'date',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'filters',
  1 => 'parameters',
  2 => 'pageToken',
  3 => 'customerId',
  4 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
}
