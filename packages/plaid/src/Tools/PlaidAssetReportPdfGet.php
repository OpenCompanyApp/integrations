<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a PDF Asset Report.
 *
 * Maps to the official Plaid endpoint post /asset_report/pdf/get.
 */
class PlaidAssetReportPdfGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_asset_report_pdf_get';
    protected const DESCRIPTION = 'Retrieve a PDF Asset Report

Official Plaid endpoint: POST /asset_report/pdf/get

The `/asset_report/pdf/get` endpoint retrieves the Asset Report in PDF format. Before calling `/asset_report/pdf/get`, you must first create the Asset Report using `/asset_report/create` (or filter an Asset Report using `/asset_report/filter`) and then wait for the [`PRODUCT_READY`](https://plaid.com/docs/api/products/assets/#product_ready) webhook to fire, indicating that the Report is ready to be retrieved. The response to `/asset_report/pdf/get` is the PDF binary data. The `request_id` is returned in the `Plaid-Request-ID` header. [View a sample PDF Asset Report](https://plaid.com/documents/sample-asset-report.pdf).

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
    protected const PATH = '/asset_report/pdf/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}