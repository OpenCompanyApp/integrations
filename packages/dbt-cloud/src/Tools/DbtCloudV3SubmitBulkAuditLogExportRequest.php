<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Submit Bulk Audit Log Export Request.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/audit-logs/export/.
 */
class DbtCloudV3SubmitBulkAuditLogExportRequest extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_submit_bulk_audit_log_export_request';
    protected const DESCRIPTION = 'Submit Bulk Audit Log Export Request

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/audit-logs/export/

Submit a bulk export request.

Note: This API is only available to enterprise customers.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/audit-logs/export/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
