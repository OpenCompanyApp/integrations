<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload a document for a blank canvas workflow step.
 *
 * Maps to the official Ramp endpoint post /developer/v1/blank-canvas-approvals/documents.
 */
class RampPostBlankCanvasApprovalDocumentResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_blank_canvas_approval_document_resource';
    protected const DESCRIPTION = 'Upload a document for a blank canvas workflow step

Official Ramp endpoint: POST /developer/v1/blank-canvas-approvals/documents

This endpoint accepts the [multipart/form-data](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods/POST) format. Include the document as a part with `Content-Disposition: attachment`. Include metadata as parts with `Content-Disposition: form-data`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/blank-canvas-approvals/documents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
