<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ExportAuditLogEventsHandlerV2.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/auditlogs/v2/export.
 */
class PulumiOrganizationsExportAuditLogEventsHandlerV2 extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_export_audit_log_events_handler_v2';
    protected const DESCRIPTION = 'ExportAuditLogEventsHandlerV2

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/auditlogs/v2/export

Exports audit log events in a downloadable format (CSV or CEF). Supports filtering by time range using startTime (lower bound) and endTime (upper bound), as well as filtering by event type and user.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Token for paginated result retrieval',
  ),
  'end_time' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `endTime` from the official Pulumi Cloud API operation. Upper bound of the query range (unix timestamp)',
  ),
  'event_filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `eventFilter` from the official Pulumi Cloud API operation. Filter audit logs by event type',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `format` from the official Pulumi Cloud API operation. Response format: \'cef\' or \'csv\' (defaults to csv)',
  ),
  'start_time' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `startTime` from the official Pulumi Cloud API operation. Lower bound of the query range (unix timestamp)',
  ),
  'user_filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `userFilter` from the official Pulumi Cloud API operation. Filter audit logs by username',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/auditlogs/v2/export';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'endTime' => 'end_time',
  'eventFilter' => 'event_filter',
  'format' => 'format',
  'startTime' => 'start_time',
  'userFilter' => 'user_filter',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
