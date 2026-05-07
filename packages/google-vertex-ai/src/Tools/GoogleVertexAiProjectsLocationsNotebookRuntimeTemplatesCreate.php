<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Notebook Runtime Templates Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/notebookRuntimeTemplates.
 */
class GoogleVertexAiProjectsLocationsNotebookRuntimeTemplatesCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_notebook_runtime_templates_create';
    protected const DESCRIPTION = 'Projects Locations Notebook Runtime Templates Create

Official Vertex AI endpoint: POST /v1/{+parent}/notebookRuntimeTemplates
Creates a NotebookRuntimeTemplate.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: notebookRuntimeTemplateId.',
  ),
  'notebookRuntimeTemplateId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `notebookRuntimeTemplateId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1NotebookRuntimeTemplate` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/notebookRuntimeTemplates';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'notebookRuntimeTemplateId',
);
    protected const BODY_REQUIRED = true;
}
