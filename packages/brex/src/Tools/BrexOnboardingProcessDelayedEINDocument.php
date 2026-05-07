<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Process a delayed EIN document after upload.
 *
 * Maps to the official Brex endpoint post /v1/referrals/{id}/process_ein_document.
 */
class BrexOnboardingProcessDelayedEINDocument extends AbstractBrexTool
{
    protected const NAME = 'brex_onboarding_process_delayed_eindocument';
    protected const DESCRIPTION = 'Process a delayed EIN document after upload

Official Brex endpoint: POST /v1/referrals/{id}/process_ein_document

Processes a delayed EIN document after it has been uploaded. This endpoint should be called after successfully uploading an IRS EIN Confirmation document (CP-575, CP-575 fax sheet, or 147C) using the standard document upload flow (`/v1/referrals/{id}/document_upload` with `type: IRS_EIN_CONFIRMATION`). The `document_id` should be the `id` returned from the document upload request.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/referrals/{id}/process_ein_document';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
