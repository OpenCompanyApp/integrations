<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Run Transformation.
 *
 * Maps to the official Fivetran endpoint post /v1/transformations/{transformationId}/run.
 */
class FivetranRunTransformation extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_run_transformation';
    protected const DESCRIPTION = 'Run Transformation

Official Fivetran endpoint: POST /v1/transformations/{transformationId}/run

Runs the transformation if a valid identifier is provided.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/transformations/{transformationId}/run';
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
