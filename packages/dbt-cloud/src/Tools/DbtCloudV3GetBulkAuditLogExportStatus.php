<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Get Bulk Audit Log Export Status.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/audit-logs/export/.
 */
class DbtCloudV3GetBulkAuditLogExportStatus extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_get_bulk_audit_log_export_status';
    protected const DESCRIPTION = 'Get Bulk Audit Log Export Status

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/audit-logs/export/

Check the status of a bulk export request.

Note: This API is only available to enterprise customers.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/audit-logs/export/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
