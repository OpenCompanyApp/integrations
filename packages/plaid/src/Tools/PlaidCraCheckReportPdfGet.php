<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Consumer Reports as a PDF.
 *
 * Maps to the official Plaid endpoint post /cra/check_report/pdf/get.
 */
class PlaidCraCheckReportPdfGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_check_report_pdf_get';
    protected const DESCRIPTION = 'Retrieve Consumer Reports as a PDF

Official Plaid endpoint: POST /cra/check_report/pdf/get

`/cra/check_report/pdf/get` retrieves the most recent Consumer Report in PDF format. By default, the most recent Base Report (if it exists) for the user will be returned. To request that the most recent Partner Insights or Income Insights report be included in the PDF as well, use the `add-ons` field.

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
    protected const PATH = '/cra/check_report/pdf/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}