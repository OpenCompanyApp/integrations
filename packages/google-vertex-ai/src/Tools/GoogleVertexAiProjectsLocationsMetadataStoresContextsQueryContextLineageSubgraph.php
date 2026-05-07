<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Contexts Query Context Lineage Subgraph.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+context}:queryContextLineageSubgraph.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresContextsQueryContextLineageSubgraph extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_contexts_query_context_lineage_subgraph';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Contexts Query Context Lineage Subgraph

Official Vertex AI endpoint: GET /v1/{+context}:queryContextLineageSubgraph
Retrieves Artifacts and Executions within the specified Context, connected by Event edges and returned as a LineageSubgraph.';
    protected const PARAMETERS = array (
  'context' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `context`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+context}:queryContextLineageSubgraph';
    protected const PATH_PARAMS = array (
  0 => 'context',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'context',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
