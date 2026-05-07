<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Transformation.
 *
 * Maps to the official Fivetran endpoint delete /v1/transformations/{transformationId}.
 */
class FivetranDeleteTransformation extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_transformation';
    protected const DESCRIPTION = 'Delete a Transformation

Official Fivetran endpoint: DELETE /v1/transformations/{transformationId}

Deletes a transformation if a valid identifier is provided.';
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
    protected const METHOD = 'delete';
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
