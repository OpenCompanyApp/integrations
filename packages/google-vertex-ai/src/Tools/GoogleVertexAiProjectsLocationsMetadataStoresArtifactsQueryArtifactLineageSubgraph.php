<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Artifacts Query Artifact Lineage Subgraph.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+artifact}:queryArtifactLineageSubgraph.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresArtifactsQueryArtifactLineageSubgraph extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_artifacts_query_artifact_lineage_subgraph';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Artifacts Query Artifact Lineage Subgraph

Official Vertex AI endpoint: GET /v1/{+artifact}:queryArtifactLineageSubgraph
Retrieves lineage of an Artifact represented through Artifacts and Executions connected by Event edges and returned as a LineageSubgraph.';
    protected const PARAMETERS = array (
  'artifact' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `artifact`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: maxHops, filter.',
  ),
  'maxHops' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxHops`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+artifact}:queryArtifactLineageSubgraph';
    protected const PATH_PARAMS = array (
  0 => 'artifact',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'artifact',
);
    protected const QUERY_KEYS = array (
  0 => 'maxHops',
  1 => 'filter',
);
    protected const BODY_REQUIRED = false;
}
