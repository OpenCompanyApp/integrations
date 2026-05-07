<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Audit Logs.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/audit-logs.
 */
class LangSmithGetAuditLogs extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_audit_logs';
    protected const DESCRIPTION = 'Get Audit Logs

Official endpoint: GET /api/v1/audit-logs
Retrieve audit log records for the authenticated user\'s organization in OCSF format. Requires both start_time and end_time parameters to filter logs within a date range. Supports cursor-based pagination. Returns results in OCSF API Activity (Class UID: 6003) format, which is compatible with security monitoring and SIEM tools. Reference: https://schema.ocsf.io/1.7.0/classes/api_activity';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, cursor, workspace_id, start_time, end_time, operations.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `cursor`.',
  ),
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `workspace_id`.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
  'end_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `end_time`.',
  ),
  'operations' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `operations`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/audit-logs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'cursor',
  2 => 'workspace_id',
  3 => 'start_time',
  4 => 'end_time',
  5 => 'operations',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
