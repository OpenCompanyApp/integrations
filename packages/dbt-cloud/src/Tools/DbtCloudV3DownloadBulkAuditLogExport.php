<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Download Bulk Audit Log Export.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/audit-logs/export/{job_identifier}/download/.
 */
class DbtCloudV3DownloadBulkAuditLogExport extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_download_bulk_audit_log_export';
    protected const DESCRIPTION = 'Download Bulk Audit Log Export

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/audit-logs/export/{job_identifier}/download/

Download a bulk export of audit log events.

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
  'job_identifier' =>
  array (
    'type' => 'string',
    'description' => 'job_identifier parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/audit-logs/export/{job_identifier}/download/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'job_identifier' => 'job_identifier',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
