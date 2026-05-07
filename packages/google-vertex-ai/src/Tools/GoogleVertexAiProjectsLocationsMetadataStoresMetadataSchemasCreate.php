<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Metadata Stores Metadata Schemas Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/metadataSchemas.
 */
class GoogleVertexAiProjectsLocationsMetadataStoresMetadataSchemasCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_metadata_stores_metadata_schemas_create';
    protected const DESCRIPTION = 'Projects Locations Metadata Stores Metadata Schemas Create

Official Vertex AI endpoint: POST /v1/{+parent}/metadataSchemas
Creates a MetadataSchema.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: metadataSchemaId.',
  ),
  'metadataSchemaId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `metadataSchemaId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1MetadataSchema` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/metadataSchemas';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'metadataSchemaId',
);
    protected const BODY_REQUIRED = true;
}
