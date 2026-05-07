<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Batches Delete.
 *
 * Maps to the official Gemini endpoint DELETE /v1beta/{+name}.
 */
class GeminiBatchesDelete extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_batches_delete';
    protected const DESCRIPTION = 'Batches Delete

Official Google Gemini endpoint: DELETE /v1beta/{+name}
Deletes a long-running operation. This method indicates that the client is no longer interested in the operation result. It does not cancel the operation. If the server doesn\'t support this method, it returns `google.rpc.Code.UNIMPLEMENTED`.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1beta/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
