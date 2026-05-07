<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Media Upload.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/ragFiles:upload.
 */
class GoogleVertexAiMediaUpload extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_media_upload';
    protected const DESCRIPTION = 'Media Upload

Official Vertex AI endpoint: POST /v1/{+parent}/ragFiles:upload
Upload a file into a RagCorpus.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1UploadRagFileRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/ragFiles:upload';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
