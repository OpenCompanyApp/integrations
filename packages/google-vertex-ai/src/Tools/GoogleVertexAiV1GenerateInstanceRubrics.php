<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * V1 Generate Instance Rubrics.
 *
 * Maps to the official Vertex AI endpoint POST /v1:generateInstanceRubrics.
 */
class GoogleVertexAiV1GenerateInstanceRubrics extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_v1_generate_instance_rubrics';
    protected const DESCRIPTION = 'V1 Generate Instance Rubrics

Official Vertex AI endpoint: POST /v1:generateInstanceRubrics
Generates rubrics for a given prompt. A rubric represents a single testable criterion for evaluation. One input prompt could have multiple rubrics This RPC allows users to get suggested rubrics based on provided prompt, which can then be reviewed and used for subsequent evaluations.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1GenerateInstanceRubricsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1:generateInstanceRubrics';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
