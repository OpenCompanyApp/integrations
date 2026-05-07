<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Upload transfer diligence document on behalf of the originator.
 *
 * Maps to the official Plaid endpoint post /transfer/diligence/document/upload.
 */
class PlaidTransferDiligenceDocumentUpload extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_diligence_document_upload';
    protected const DESCRIPTION = 'Upload transfer diligence document on behalf of the originator

Official Plaid endpoint: POST /transfer/diligence/document/upload

Third-party sender customers can use `/transfer/diligence/document/upload` endpoint to upload a document on behalf of its end customer (i.e. originator) to Plaid. You’ll need to send a request of type multipart/form-data. You must provide the `client_id` in the `PLAID-CLIENT-ID` header and `secret` in the `PLAID-SECRET` header.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/diligence/document/upload';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}