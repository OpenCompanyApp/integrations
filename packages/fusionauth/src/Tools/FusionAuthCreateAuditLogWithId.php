<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Audit Log With Id.
 *
 * Maps to POST /api/system/audit-log in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateAuditLogWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_audit_log_with_id',
  'class' => 'FusionAuthCreateAuditLogWithId',
  'method' => 'POST',
  'path' => '/api/system/audit-log',
  'operation_id' => 'createAuditLogWithId',
  'summary' => 'create Audit Log With Id',
  'description' => 'Creates an audit log with the message and user name (usually an email). Audit logs should be written anytime you make changes to the FusionAuth database. When using the FusionAuth App web interface, any changes are automatically written to the audit log. However, if you are accessing the API, you must write the audit logs yourself.',
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
