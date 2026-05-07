<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get Export.
 *
 * Maps to the official WorkOS endpoint get /audit_logs/exports/{auditLogExportId}.
 */
class WorkOSAuditLogExportsExport extends AbstractWorkOSTool
{
    protected const NAME = 'workos_audit_log_exports_export';
    protected const DESCRIPTION = 'Get Export

Official WorkOS endpoint: GET /audit_logs/exports/{auditLogExportId}

Get an Audit Log Export. The URL will expire after 10 minutes. If the export is needed again at a later time, refetching the export will regenerate the URL.';
    protected const PARAMETERS = array (
  'audit_log_export_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `auditLogExportId` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/audit_logs/exports/{auditLogExportId}';
    protected const PATH_PARAMS = array (
  'auditLogExportId' => 'audit_log_export_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
