<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Evaluation Items Delete.
 *
 * Maps to the official Vertex AI endpoint DELETE /v1/{+name}.
 */
class GoogleVertexAiProjectsLocationsEvaluationItemsDelete extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_evaluation_items_delete';
    protected const DESCRIPTION = 'Projects Locations Evaluation Items Delete

Official Vertex AI endpoint: DELETE /v1/{+name}
Deletes an Evaluation Item.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
