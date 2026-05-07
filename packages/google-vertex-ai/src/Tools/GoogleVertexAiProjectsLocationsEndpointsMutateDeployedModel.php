<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Endpoints Mutate Deployed Model.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+endpoint}:mutateDeployedModel.
 */
class GoogleVertexAiProjectsLocationsEndpointsMutateDeployedModel extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_endpoints_mutate_deployed_model';
    protected const DESCRIPTION = 'Projects Locations Endpoints Mutate Deployed Model

Official Vertex AI endpoint: POST /v1/{+endpoint}:mutateDeployedModel
Updates an existing deployed model. Updatable fields include `min_replica_count`, `max_replica_count`, `required_replica_count`, `autoscaling_metric_specs`, `disable_container_logging` (v1 only), and `enable_container_logging` (v1beta1 only).';
    protected const PARAMETERS = array (
  'endpoint' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `endpoint`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1MutateDeployedModelRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+endpoint}:mutateDeployedModel';
    protected const PATH_PARAMS = array (
  0 => 'endpoint',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'endpoint',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
