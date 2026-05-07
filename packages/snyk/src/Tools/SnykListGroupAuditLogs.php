<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Search Group audit logs..
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/audit_logs/search.
 */
class SnykListGroupAuditLogs extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_group_audit_logs';
    protected const DESCRIPTION = 'Search Group audit logs.

Official Snyk endpoint: GET /groups/{group_id}/audit_logs/search

Search audit logs for a Group. "api.access" events are omitted from results unless explicitly requested using the events parameter. Some Organization level events are supported as well as the following Group level events: - api.access - group.cloud_config.settings.edit - group.create - group.delete - group.edit - group.notification_settings.edit - group.org.add - group.org.remove - group.policy.create - group.policy.delete - group.policy.edit - group.request_access_settings.edit - group.role.create - group.role.delete - group.role.edit - group.service_account.create - group.service_account.delete - group.service_account.edit - group.settings.edit - group.settings.feature_flag.edit - group.sso.add - group.sso.auth0_connection.create - group.sso.auth0_connection.edit - group.sso.create - group.sso.delete - group.sso.edit - group.sso.membership.sync - group.sso.remove - group.tag.create ...';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the Group.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Snyk API operation. The ID for the next page of results.',
  ),
  'from' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from` from the official Snyk API operation. The start date (inclusive) of the audit logs search. If not specified, the start of yesterday is used. Dates should be formatted as RFC33...',
  ),
  'to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to` from the official Snyk API operation. The end date (exclusive) of the audit logs search. Dates should be formatted as RFC3339, e.g. 2024-01-02T16:30:00Z.',
  ),
  'size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `size` from the official Snyk API operation. Number of results to return per page.',
  ),
  'sort_order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort_order` from the official Snyk API operation. Order in which results are returned.',
    'enum' =>
    array (
      0 => 'ASC',
      1 => 'DESC',
    ),
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Snyk API operation. Filter logs by user ID.',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `project_id` from the official Snyk API operation. Filter logs by project ID.',
  ),
  'events' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `events` from the official Snyk API operation. Filter logs by event types, cannot be used in conjunction with exclude_events parameter.',
  ),
  'exclude_events' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `exclude_events` from the official Snyk API operation. Exclude event types from results, cannot be used in conjunctions with events parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/audit_logs/search';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'cursor' => 'cursor',
  'from' => 'from',
  'to' => 'to',
  'size' => 'size',
  'sort_order' => 'sort_order',
  'user_id' => 'user_id',
  'project_id' => 'project_id',
  'events' => 'events',
  'exclude_events' => 'exclude_events',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
