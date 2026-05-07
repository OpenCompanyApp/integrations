<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Persistent Resources Reboot.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:reboot.
 */
class GoogleVertexAiProjectsLocationsPersistentResourcesReboot extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_persistent_resources_reboot';
    protected const DESCRIPTION = 'Projects Locations Persistent Resources Reboot

Official Vertex AI endpoint: POST /v1/{+name}:reboot
Reboots a PersistentResource.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1RebootPersistentResourceRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:reboot';
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
