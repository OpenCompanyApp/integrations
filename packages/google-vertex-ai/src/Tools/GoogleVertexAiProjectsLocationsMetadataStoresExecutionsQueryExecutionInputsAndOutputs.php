<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Executions Query Execution Inputs And Outputs.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+execution}:queryExecutionInputsAndOutputs.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresExecutionsQueryExecutionInputsAndOutputs extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_executions_query_execution_inputs_and_outputs';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Executions Query Execution Inputs And Outputs

Official Vertex AI endpoint: GET /v1/{+execution}:queryExecutionInputsAndOutputs
Obtains the set of input and output Artifacts for this Execution, in the form of LineageSubgraph that also contains the Execution and connecting Events.';
    protected const PARAMETERS = array (
  'execution' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `execution`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+execution}:queryExecutionInputsAndOutputs';
    protected const PATH_PARAMS = array (
  0 => 'execution',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'execution',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
