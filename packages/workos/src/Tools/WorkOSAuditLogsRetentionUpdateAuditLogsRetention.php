<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Set Retention.
 *
 * Maps to the official WorkOS endpoint put /organizations/{id}/audit_logs_retention.
 */
class WorkOSAuditLogsRetentionUpdateAuditLogsRetention extends AbstractWorkOSTool
{
    protected const NAME = 'workos_audit_logs_retention_update_audit_logs_retention';
    protected const DESCRIPTION = 'Set Retention

Official WorkOS endpoint: PUT /organizations/{id}/audit_logs_retention

Set the event retention period for the given Organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/organizations/{id}/audit_logs_retention';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
