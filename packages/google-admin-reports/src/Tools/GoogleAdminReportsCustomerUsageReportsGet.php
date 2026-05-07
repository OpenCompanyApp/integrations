<?php

namespace OpenCompany\Integrations\GoogleAdminReports\Tools;

/**
 * Customer Usage Reports Get.
 *
 * Maps to the official Admin Reports endpoint GET /admin/reports/v1/usage/dates/{date}.
 */
class GoogleAdminReportsCustomerUsageReportsGet extends AbstractGoogleAdminReportsTool
{
    protected const NAME = 'google_admin_reports_customer_usage_reports_get';
    protected const DESCRIPTION = 'Customer Usage Reports Get

Official Admin Reports endpoint: GET /admin/reports/v1/usage/dates/{date}
Retrieves a report which is a collection of properties and statistics for a specific customer\'s account.';
    protected const PARAMETERS = array (
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
    'description' => 'Query string parameters accepted by the official Admin Reports method. Known keys: pageToken, customerId, parameters.',
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
  'parameters' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `parameters`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/reports/v1/usage/dates/{date}';
    protected const PATH_PARAMS = array (
  0 => 'date',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'customerId',
  2 => 'parameters',
);
    protected const BODY_REQUIRED = false;
}
