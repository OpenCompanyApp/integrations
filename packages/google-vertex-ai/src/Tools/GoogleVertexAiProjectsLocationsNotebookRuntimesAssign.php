<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Notebook Runtimes Assign.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/notebookRuntimes:assign.
 */
class GoogleVertexAiProjectsLocationsNotebookRuntimesAssign extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_notebook_runtimes_assign';
    protected const DESCRIPTION = 'Projects Locations Notebook Runtimes Assign

Official Vertex AI endpoint: POST /v1/{+parent}/notebookRuntimes:assign
Assigns a NotebookRuntime to a user for a particular Notebook file. This method will either returns an existing assignment or generates a new one.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1AssignNotebookRuntimeRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/notebookRuntimes:assign';
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
