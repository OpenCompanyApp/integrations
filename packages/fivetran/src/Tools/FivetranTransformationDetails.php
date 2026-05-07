<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Transformation Details.
 *
 * Maps to the official Fivetran endpoint get /v1/transformations/{transformationId}.
 */
class FivetranTransformationDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_transformation_details';
    protected const DESCRIPTION = 'Retrieve Transformation Details

Official Fivetran endpoint: GET /v1/transformations/{transformationId}

Returns a transformation details if a valid identifier is provided.';
    protected const PARAMETERS = array (
  'transformation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `transformationId` from the official Fivetran API operation. The unique identifier for the transformation within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/transformations/{transformationId}';
    protected const PATH_PARAMS = array (
  'transformationId' => 'transformation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
