<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Transfer Ownership.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+name}:transferOwnership.
 */
class GeminiTunedModelsTransferOwnership extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_transfer_ownership';
    protected const DESCRIPTION = 'Tuned Models Transfer Ownership

Official Google Gemini endpoint: POST /v1beta/{+name}:transferOwnership
Transfers ownership of the tuned model. This is the only way to change ownership of the tuned model. The current owner will be downgraded to writer role.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `TransferOwnershipRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+name}:transferOwnership';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
