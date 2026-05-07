<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Reasoning Engines Runtime Revisions Stream Query.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:streamQuery.
 */
class GoogleVertexAiReasoningEnginesRuntimeRevisionsStreamQuery extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_reasoning_engines_runtime_revisions_stream_query';
    protected const DESCRIPTION = 'Reasoning Engines Runtime Revisions Stream Query

Official Vertex AI endpoint: POST /v1/{+name}:streamQuery
Streams queries using a reasoning engine.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1StreamQueryReasoningEngineRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:streamQuery';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
