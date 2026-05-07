<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAuditLogEventsHandlerV1.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/auditlogs.
 */
class PulumiOrganizationsListAuditLogEventsHandlerV1 extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_audit_log_events_handler_v1';
    protected const DESCRIPTION = 'ListAuditLogEventsHandlerV1

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/auditlogs

Lists audit log events for an organization. Either continuationToken or startTime is required. Supports filtering by event type and user.';
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
    'description' => 'Query parameter `format` from the official Pulumi Cloud API operation. Response format: \'json\' (default)',
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
    protected const PATH = '/api/orgs/{orgName}/auditlogs';
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
