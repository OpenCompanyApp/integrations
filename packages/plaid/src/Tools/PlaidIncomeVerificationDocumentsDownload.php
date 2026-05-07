<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * (Deprecated) Download the original documents used for income verification.
 *
 * Maps to the official Plaid endpoint post /income/verification/documents/download.
 */
class PlaidIncomeVerificationDocumentsDownload extends AbstractPlaidTool
{
    protected const NAME = 'plaid_income_verification_documents_download';
    protected const DESCRIPTION = '(Deprecated) Download the original documents used for income verification

Official Plaid endpoint: POST /income/verification/documents/download

`/income/verification/documents/download` provides the ability to download the source documents associated with the verification. If Document Income was used, the documents will be those the user provided in Link. For Payroll Income, the most recent files available for download from the payroll provider will be available from this endpoint. The response to `/income/verification/documents/download` is a ZIP file in binary data. If a `document_id` is passed, a single document will be contained in this file. If not, the response will contain all documents associated with the verification. The `request_id` is returned in the `Plaid-Request-ID` header.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/income/verification/documents/download';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}