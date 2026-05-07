<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List spend programs.
 *
 * Maps to the official Ramp endpoint get /developer/v1/spend-programs.
 */
class RampGetSpendProgramResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_spend_program_resource';
    protected const DESCRIPTION = 'List spend programs

Official Ramp endpoint: GET /developer/v1/spend-programs';
    protected const PARAMETERS = array (
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
    protected const PATH = '/developer/v1/spend-programs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
