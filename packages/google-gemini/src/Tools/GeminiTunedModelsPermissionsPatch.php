<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Tuned Models Permissions Patch.
 *
 * Maps to the official Gemini endpoint PATCH /v1beta/{+name}.
 */
class GeminiTunedModelsPermissionsPatch extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_tuned_models_permissions_patch';
    protected const DESCRIPTION = 'Tuned Models Permissions Patch

Official Google Gemini endpoint: PATCH /v1beta/{+name}
Updates the permission.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Gemini API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Gemini method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. The list of fields to update. Accepted ones: - role (`Permission.role` field)',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `Permission` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1beta/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
