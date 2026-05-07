<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * V1 Evaluate Instances.
 *
 * Maps to the official Vertex AI endpoint POST /v1:evaluateInstances.
 */
class GoogleVertexAiV1EvaluateInstances extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_v1_evaluate_instances';
    protected const DESCRIPTION = 'V1 Evaluate Instances

Official Vertex AI endpoint: POST /v1:evaluateInstances
Evaluates instances based on a given metric.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1EvaluateInstancesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1:evaluateInstances';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
