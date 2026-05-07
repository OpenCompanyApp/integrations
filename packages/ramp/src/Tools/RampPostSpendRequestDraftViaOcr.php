<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a draft spend request via OCR.
 *
 * Maps to the official Ramp endpoint post /developer/v1/spend-requests/draft-via-ocr.
 */
class RampPostSpendRequestDraftViaOcr extends AbstractRampTool
{
    protected const NAME = 'ramp_post_spend_request_draft_via_ocr';
    protected const DESCRIPTION = 'Create a draft spend request via OCR

Official Ramp endpoint: POST /developer/v1/spend-requests/draft-via-ocr

Requests should be made with `multipart/form-data` content type.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/spend-requests/draft-via-ocr';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
