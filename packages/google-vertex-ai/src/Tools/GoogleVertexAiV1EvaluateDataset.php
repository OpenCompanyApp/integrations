<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * V1 Evaluate Dataset.
 *
 * Maps to the official Vertex AI endpoint POST /v1:evaluateDataset.
 */
class GoogleVertexAiV1EvaluateDataset extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_v1_evaluate_dataset';
    protected const DESCRIPTION = 'V1 Evaluate Dataset

Official Vertex AI endpoint: POST /v1:evaluateDataset
Evaluates a dataset based on a set of given metrics.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1EvaluateDatasetRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1:evaluateDataset';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
