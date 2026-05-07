<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Executions Add Execution Events.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+execution}:addExecutionEvents.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresExecutionsAddExecutionEvents extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_executions_add_execution_events';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Executions Add Execution Events

Official Vertex AI endpoint: POST /v1/{+execution}:addExecutionEvents
Adds Events to the specified Execution. An Event indicates whether an Artifact was used as an input or output for an Execution. If an Event already exists between the Execution and the Artifact, the Event is skipped.';
    protected const PARAMETERS = array (
  'execution' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `execution`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1AddExecutionEventsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+execution}:addExecutionEvents';
    protected const PATH_PARAMS = array (
  0 => 'execution',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'execution',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
