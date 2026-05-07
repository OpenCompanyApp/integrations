<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a PDF Asset Report Audit Copy.
 *
 * Maps to the official Plaid endpoint post /asset_report/audit_copy/pdf/get.
 */
class PlaidAssetReportAuditCopyPdfGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_audit_copy_pdf_get';
    protected const DESCRIPTION = 'Retrieve a PDF Asset Report Audit Copy

Official Plaid endpoint: POST /asset_report/audit_copy/pdf/get

The `/asset_report/audit_copy/pdf/get` endpoint retrieves an Asset Report Audit Copy in PDF format. The caller must provide the `audit_copy_token` that was shared via the `/asset_report/audit_copy/create` endpoint. The response to `/asset_report/audit_copy/pdf/get` is the PDF binary data. The `request_id` is returned in the `Plaid-Request-ID` header. [View a sample PDF Asset Report](https://plaid.com/documents/sample-asset-report.pdf).

This endpoint can return binary content such as PDF data. Non-JSON responses are returned as `{body, status}`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/asset_report/audit_copy/pdf/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}