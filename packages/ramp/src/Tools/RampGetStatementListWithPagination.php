<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List statements.
 *
 * Maps to the official Ramp endpoint get /developer/v1/statements.
 */
class RampGetStatementListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_statement_list_with_pagination';
    protected const DESCRIPTION = 'List statements

Official Ramp endpoint: GET /developer/v1/statements';
    protected const PARAMETERS = array (
  'from_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_date` from the official Ramp API operation.',
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_date` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/statements';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
