<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload documents for a vendor agreement.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vendors/agreements/{agreement_id}/documents.
 */
class RampPostVendorAgreementDocumentUploadResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_vendor_agreement_document_upload_resource';
    protected const DESCRIPTION = 'Upload documents for a vendor agreement

Official Ramp endpoint: POST /developer/v1/vendors/agreements/{agreement_id}/documents

This endpoint accepts the [multipart/form-data](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods/POST) format. Include each agreement file as a repeated `documents` part. The request must also include an `X-Idempotency-Key` header.';
    protected const PARAMETERS = array (
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agreement_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/vendors/agreements/{agreement_id}/documents';
    protected const PATH_PARAMS = array (
  'agreement_id' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
