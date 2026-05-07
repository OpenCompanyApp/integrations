<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload a receipt.
 *
 * Maps to the official Ramp endpoint post /developer/v1/receipts.
 */
class RampPostReceiptUpload extends AbstractRampTool
{
    protected const NAME = 'ramp_post_receipt_upload';
    protected const DESCRIPTION = 'Upload a receipt

Official Ramp endpoint: POST /developer/v1/receipts

image and optionally associate it with a transaction. If a `transaction_id` is provided, the receipt will be linked directly to that transaction. If not, Ramp will attempt to automatically match the receipt to the most relevant transaction based on context. This endpoint accepts the [multipart/form-data](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods/POST) format. Include the receipt image as a part with `Content-Disposition: attachment`. Include metadata as parts with `Content-Disposition: form-data`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/receipts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
