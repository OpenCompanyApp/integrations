<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get localized phrases.
 *
 * Maps to GET /api/.well-known/phrases in the official Logto OpenAPI source.
 */
class LogtoGetSignInExperiencePhrases extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_sign_in_experience_phrases',
  'class' => 'LogtoGetSignInExperiencePhrases',
  'method' => 'GET',
  'path' => '/api/.well-known/phrases',
  'operation_id' => 'GetSignInExperiencePhrases',
  'summary' => 'Get localized phrases',
  'description' => 'Get localized phrases based on the specified language.',
  'parameters' =>
  array (
    'lng' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The language tag for localization.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'lng' => 'lng',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
