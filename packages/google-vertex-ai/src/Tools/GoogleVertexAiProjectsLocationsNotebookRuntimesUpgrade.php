<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Notebook Runtimes Upgrade.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:upgrade.
 */
class GoogleVertexAiProjectsLocationsNotebookRuntimesUpgrade extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_notebook_runtimes_upgrade';
    protected const DESCRIPTION = 'Projects Locations Notebook Runtimes Upgrade

Official Vertex AI endpoint: POST /v1/{+name}:upgrade
Upgrades a NotebookRuntime.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1UpgradeNotebookRuntimeRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:upgrade';
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
