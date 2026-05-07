<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload a receipt for a reimbursement.
 *
 * Maps to the official Ramp endpoint post /developer/v1/reimbursements/submit-receipt.
 */
class RampPostReimbursementReceiptUpload extends AbstractRampTool
{
    protected const NAME = 'ramp_post_reimbursement_receipt_upload';
    protected const DESCRIPTION = 'Upload a receipt for a reimbursement

Official Ramp endpoint: POST /developer/v1/reimbursements/submit-receipt

If a `reimbursement_id` is provided, the receipt will be linked directly to that reimbursement. If not, Ramp will attempt to automatically create a draft reimbursement via OCR. This endpoint accepts the [multipart/form-data](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods/POST) format. Include the receipt image as a part with `Content-Disposition: attachment`. Include metadata as parts with `Content-Disposition: form-data`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/reimbursements/submit-receipt';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
