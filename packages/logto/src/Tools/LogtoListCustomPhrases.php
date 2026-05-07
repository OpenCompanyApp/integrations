<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get all custom phrases.
 *
 * Maps to GET /api/custom-phrases in the official Logto OpenAPI source.
 */
class LogtoListCustomPhrases extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_custom_phrases',
  'class' => 'LogtoListCustomPhrases',
  'method' => 'GET',
  'path' => '/api/custom-phrases',
  'operation_id' => 'ListCustomPhrases',
  'summary' => 'Get all custom phrases',
  'description' => 'Get all custom phrases for all languages.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
