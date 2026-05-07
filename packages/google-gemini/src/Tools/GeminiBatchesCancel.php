<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Batches Cancel.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+name}:cancel.
 */
class GeminiBatchesCancel extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_batches_cancel';
    protected const DESCRIPTION = 'Batches Cancel

Official Google Gemini endpoint: POST /v1beta/{+name}:cancel
Starts asynchronous cancellation on a long-running operation. The server makes a best effort to cancel the operation, but success is not guaranteed. If the server doesn\'t support this method, it returns `google.rpc.Code.UNIMPLEMENTED`. Clients can use Operations.GetOperation or other methods to check whether the cancellation succeeded or whether the operation completed despite cancellation. On successful cancellation, the operation is not deleted; instead, it becomes an operation with an Operation.error value with a google.rpc.Status.code of `1`, corresponding to `Code.CANCELLED`.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+name}:cancel';
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
