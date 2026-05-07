<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tensorboards Read Size.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+tensorboard}:readSize.
 */
class GoogleVertexAiProjectsLocationsTensorboardsReadSize extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tensorboards_read_size';
    protected const DESCRIPTION = 'Projects Locations Tensorboards Read Size

Official Vertex AI endpoint: GET /v1/{+tensorboard}:readSize
Returns the storage size for a given TensorBoard instance.';
    protected const PARAMETERS = array (
  'tensorboard' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tensorboard`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+tensorboard}:readSize';
    protected const PATH_PARAMS = array (
  0 => 'tensorboard',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'tensorboard',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
