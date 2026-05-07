<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Featurestores Entity Types Import Feature Values.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+entityType}:importFeatureValues.
 */
class GoogleVertexAiProjectsLocationsFeaturestoresEntityTypesImportFeatureValues extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_featurestores_entity_types_import_feature_values';
    protected const DESCRIPTION = 'Projects Locations Featurestores Entity Types Import Feature Values

Official Vertex AI endpoint: POST /v1/{+entityType}:importFeatureValues
Imports Feature values into the Featurestore from a source storage. The progress of the import is tracked by the returned operation. The imported features are guaranteed to be visible to subsequent read operations after the operation is marked as successfully done. If an import operation fails, the Feature values returned from reads and exports may be inconsistent. If consistency is required, the caller must retry the same import request again and wait till the new operation returned is marked as successfully done. There are also scenarios where the caller can cause inconsistency. - Source data for import contains multiple distinct Feature values for the same entity ID and timestamp. - Source is modified during an import. This includes adding, updating, or removing source data and/or metadata. Examples of updating metadata include but are not limited to changing storage location, storage class, or retention policy. - Online serving cluster is under-provisioned.';
    protected const PARAMETERS = array (
  'entityType' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `entityType`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1ImportFeatureValuesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+entityType}:importFeatureValues';
    protected const PATH_PARAMS = array (
  0 => 'entityType',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'entityType',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
