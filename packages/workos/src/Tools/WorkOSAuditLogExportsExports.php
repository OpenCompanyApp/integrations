<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create Export.
 *
 * Maps to the official WorkOS endpoint post /audit_logs/exports.
 */
class WorkOSAuditLogExportsExports extends AbstractWorkOSTool
{
    protected const NAME = 'workos_audit_log_exports_exports';
    protected const DESCRIPTION = 'Create Export

Official WorkOS endpoint: POST /audit_logs/exports

Create an Audit Log Export. Exports are scoped to a single organization within a specified date range.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/audit_logs/exports';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
