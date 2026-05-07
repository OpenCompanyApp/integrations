<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create a new document upload.
 *
 * Maps to the official Brex endpoint post /v1/referrals/{id}/document_upload.
 */
class BrexOnboardingCreateDocument extends AbstractBrexTool
{
    protected const NAME = 'brex_onboarding_create_document';
    protected const DESCRIPTION = 'Create a new document upload

Official Brex endpoint: POST /v1/referrals/{id}/document_upload

The `uri` will be a presigned S3 URL allowing you to upload the referral doc securely. This URL can only be used for a `PUT` operation and expires 30 minutes after its creation. Once your upload is complete, we will use this to prefill the application. Refer to these [docs](https://docs.aws.amazon.com/AmazonS3/latest/dev/PresignedUrlUploadObject.html) on how to upload to this presigned S3 URL. We highly recommend using one of AWS SDKs if they\'re available for your language to upload these files.';
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
    protected const PATH = '/v1/referrals/{id}/document_upload';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
