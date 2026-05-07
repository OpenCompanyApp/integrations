<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

/**
 * Batches Update Embed Content Batch.
 *
 * Maps to the official Gemini endpoint PATCH /v1beta/{+name}:updateEmbedContentBatch.
 */
class GeminiBatchesUpdateEmbedContentBatch extends AbstractGeminiTool
{
    protected const NAME = 'google_gemini_batches_update_embed_content_batch';
    protected const DESCRIPTION = 'Batches Update Embed Content Batch

Official Google Gemini endpoint: PATCH /v1beta/{+name}:updateEmbedContentBatch
Updates a batch of EmbedContent requests for batch processing.';
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
    'description' => 'Optional. The list of fields to update.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Gemini API `EmbedContentBatch` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1beta/{+name}:updateEmbedContentBatch';
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
