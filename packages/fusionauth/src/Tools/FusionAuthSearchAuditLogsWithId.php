<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Audit Logs With Id.
 *
 * Maps to POST /api/system/audit-log/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchAuditLogsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_audit_logs_with_id',
  'class' => 'FusionAuthSearchAuditLogsWithId',
  'method' => 'POST',
  'path' => '/api/system/audit-log/search',
  'operation_id' => 'searchAuditLogsWithId',
  'summary' => 'search Audit Logs With Id',
  'description' => 'Searches the audit logs with the specified criteria and pagination.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
