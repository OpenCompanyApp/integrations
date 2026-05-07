<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Search Organization audit logs..
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/audit_logs/search.
 */
class SnykListOrgAuditLogs extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_org_audit_logs';
    protected const DESCRIPTION = 'Search Organization audit logs.

Official Snyk endpoint: GET /orgs/{org_id}/audit_logs/search

Search audit logs for an Organization. "api.access" events are omitted from results unless explicitly requested using the events parameter. Supported event types: - api.access - org.app_bot.create - org.app.create - org.app.delete - org.app.edit - org.cloud_config.settings.edit - org.collection.create - org.collection.delete - org.collection.edit - org.create - org.delete - org.edit - org.ignore_policy.edit - org.integration.create - org.integration.delete - org.integration.edit - org.integration.settings.edit - org.language_settings.edit - org.notification_settings.edit - org.org_source.create - org.org_source.delete - org.org_source.edit - org.policy.create - org.policy.edit - org.policy.delete - org.project_filter.create - org.project_filter.delete - org.project.add - org.project.attributes.edit - org.project.delete - org.project.edit - org.project.fix_pr.auto_open - org.project.fi...';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the organization.',
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
    protected const PATH = '/orgs/{org_id}/audit_logs/search';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
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
