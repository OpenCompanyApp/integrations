<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Transformation.
 *
 * Maps to the official Fivetran endpoint patch /v1/transformations/{transformationId}.
 */
class FivetranUpdateTransformation extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_update_transformation';
    protected const DESCRIPTION = 'Update a Transformation

Official Fivetran endpoint: PATCH /v1/transformations/{transformationId}

Updates the transformation if a valid identifier is provided.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
