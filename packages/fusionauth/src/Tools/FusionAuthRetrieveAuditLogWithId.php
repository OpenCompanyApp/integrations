<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Audit Log With Id.
 *
 * Maps to GET /api/system/audit-log/{auditLogId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveAuditLogWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_audit_log_with_id',
  'class' => 'FusionAuthRetrieveAuditLogWithId',
  'method' => 'GET',
  'path' => '/api/system/audit-log/{auditLogId}',
  'operation_id' => 'retrieveAuditLogWithId',
  'summary' => 'retrieve Audit Log With Id',
  'description' => 'Retrieves a single audit log for the given Id.',
  'parameters' =>
  array (
    'audit_log_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the audit log to retrieve.',
    ),
  ),
  'path_params' =>
  array (
    'auditLogId' => 'audit_log_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
