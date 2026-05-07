<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Consumer Reports as a Verification PDF.
 *
 * Maps to the official Plaid endpoint post /cra/check_report/verification/pdf/get.
 */
class PlaidCraCheckReportVerificationPdfGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_check_report_verification_pdf_get';
    protected const DESCRIPTION = 'Retrieve Consumer Reports as a Verification PDF

Official Plaid endpoint: POST /cra/check_report/verification/pdf/get

The `/cra/check_report/verification/pdf/get` endpoint retrieves the most recent Consumer Report in PDF format, specifically formatted for Home Lending verification use cases. Before calling this endpoint, ensure that you\'ve created a VOA report through Link or the `/cra/check_report/create` endpoint, and have received a `CHECK_REPORT_READY` or a `USER_CHECK_REPORT_READY` webhook. The response to `/cra/check_report/verification/pdf/get` is the PDF binary data. The `request_id` is returned in the `Plaid-Request-ID` header.

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
    protected const PATH = '/cra/check_report/verification/pdf/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}