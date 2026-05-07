<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload a file attachment to an existing draft bill.
 *
 * Maps to the official Ramp endpoint post /developer/v1/bills/drafts/{draft_bill_id}/attachments.
 */
class RampPostDraftBillAttachmentUploadResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_draft_bill_attachment_upload_resource';
    protected const DESCRIPTION = 'Upload a file attachment to an existing draft bill

Official Ramp endpoint: POST /developer/v1/bills/drafts/{draft_bill_id}/attachments

Upload a file as an attachment to a draft bill. INVOICE type attachments cannot be uploaded if one already exists on the draft bill. This endpoint accepts the [multipart/form-data](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods/POST) format. Include the file as a part named \'file\' with `Content-Disposition: attachment`. Include the attachment_type as a form field.';
    protected const PARAMETERS = array (
  'draft_bill_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `draft_bill_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/bills/drafts/{draft_bill_id}/attachments';
    protected const PATH_PARAMS = array (
  'draft_bill_id' => 'draft_bill_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
