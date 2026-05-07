<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get Retention.
 *
 * Maps to the official WorkOS endpoint get /organizations/{id}/audit_logs_retention.
 */
class WorkOSAuditLogsRetentionAuditLogsRetention extends AbstractWorkOSTool
{
    protected const NAME = 'workos_audit_logs_retention_audit_logs_retention';
    protected const DESCRIPTION = 'Get Retention

Official WorkOS endpoint: GET /organizations/{id}/audit_logs_retention

Get the configured event retention period for the given Organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/organizations/{id}/audit_logs_retention';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
