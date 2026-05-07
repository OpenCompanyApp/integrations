<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a PDF Reports.
 *
 * Maps to the official Plaid endpoint post /consumer_report/pdf/get.
 */
class PlaidConsumerReportPdfGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_consumer_report_pdf_get';
    protected const DESCRIPTION = 'Retrieve a PDF Reports

Official Plaid endpoint: POST /consumer_report/pdf/get

Retrieves all existing CRB Bank Income and Base reports for the consumer in PDF format. Response is PDF binary data. The `request_id` is returned in the `Plaid-Request-ID` header.

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
    protected const PATH = '/consumer_report/pdf/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}