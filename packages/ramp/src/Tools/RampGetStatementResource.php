<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a statement.
 *
 * Maps to the official Ramp endpoint get /developer/v1/statements/{statement_id}.
 */
class RampGetStatementResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_statement_resource';
    protected const DESCRIPTION = 'Fetch a statement

Official Ramp endpoint: GET /developer/v1/statements/{statement_id}';
    protected const PARAMETERS = array (
  'statement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `statement_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/statements/{statement_id}';
    protected const PATH_PARAMS = array (
  'statement_id' => 'statement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
