<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Notebook Runtime Templates Set Iam Policy.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+resource}:setIamPolicy.
 */
class GoogleVertexAiProjectsLocationsNotebookRuntimeTemplatesSetIamPolicy extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_notebook_runtime_templates_set_iam_policy';
    protected const DESCRIPTION = 'Projects Locations Notebook Runtime Templates Set Iam Policy

Official Vertex AI endpoint: POST /v1/{+resource}:setIamPolicy
Sets the access control policy on the specified resource. Replaces any existing policy. Can return `NOT_FOUND`, `INVALID_ARGUMENT`, and `PERMISSION_DENIED` errors.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleIamV1SetIamPolicyRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+resource}:setIamPolicy';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
