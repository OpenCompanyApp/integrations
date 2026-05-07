<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Cancel Running Transformation.
 *
 * Maps to the official Fivetran endpoint post /v1/transformations/{transformationId}/cancel.
 */
class FivetranCancelTransformation extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_cancel_transformation';
    protected const DESCRIPTION = 'Cancel Running Transformation

Official Fivetran endpoint: POST /v1/transformations/{transformationId}/cancel

Cancels the execution of the transformation if a valid identifier is provided.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/transformations/{transformationId}/cancel';
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
