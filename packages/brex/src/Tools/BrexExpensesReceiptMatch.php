<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create a new receipt match.
 *
 * Maps to the official Brex endpoint post /v1/expenses/card/receipt_match.
 */
class BrexExpensesReceiptMatch extends AbstractBrexTool
{
    protected const NAME = 'brex_expenses_receipt_match';
    protected const DESCRIPTION = 'Create a new receipt match

Official Brex endpoint: POST /v1/expenses/card/receipt_match

The `uri` will be a pre-signed S3 URL allowing you to upload the receipt securely. This URL can only be used for a `PUT` operation and expires 30 minutes after its creation. Once your upload is complete, we will try to match the receipt with existing expenses. Refer to these [docs](https://docs.aws.amazon.com/AmazonS3/latest/dev/PresignedUrlUploadObject.html) on how to upload to this pre-signed S3 URL. We highly recommend using one of AWS SDKs if they\'re available for your language to upload these files.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/expenses/card/receipt_match';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
