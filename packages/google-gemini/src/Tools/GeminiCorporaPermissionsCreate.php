<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Corpora Permissions Create.
 *
 * Maps to the official Gemini endpoint POST /v1beta/{+parent}/permissions.
 */
class GeminiCorporaPermissionsCreate extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_corpora_permissions_create';
    protected const DESCRIPTION = 'Corpora Permissions Create

Official Google Gemini endpoint: POST /v1beta/{+parent}/permissions
Create a permission to a specific resource.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Gemini API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `Permission` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1beta/{+parent}/permissions';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
