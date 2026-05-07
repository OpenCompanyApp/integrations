<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ExportAuditLogEventsHandlerV1.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/auditlogs/export.
 */
class PulumiOrganizationsExportAuditLogEventsHandlerV1 extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_export_audit_log_events_handler_v1';
    protected const DESCRIPTION = 'ExportAuditLogEventsHandlerV1

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/auditlogs/export

Exports audit log events for an organization in a downloadable format. Audit logs provide an immutable record of all user activity within the organization, including stack operations, member changes, and policy modifications. Results can be filtered by time range, event type, and user. Supported export formats are CSV and CEF (Common Event Format for SIEM integration). Pagination is supported via the continuationToken parameter. **Important:** This endpoint differs from other API endpoints: - The response is always **gzip compressed**. Use `--compressed` with curl or handle gzip decompression in your client. - The `Content-Type: application/json` response header is omitted. Note: In V1, startTime specifies the upper bound of the query range. Use the V2 endpoint for more intuitive time range semantics.';
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
    'description' => 'Query parameter `startTime` from the official Pulumi Cloud API operation. Returns entries older than this timestamp (unix timestamp)',
  ),
  'user_filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `userFilter` from the official Pulumi Cloud API operation. Filter audit logs by username',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/auditlogs/export';
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
