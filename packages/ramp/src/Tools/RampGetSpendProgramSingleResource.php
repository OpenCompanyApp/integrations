<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a spend program.
 *
 * Maps to the official Ramp endpoint get /developer/v1/spend-programs/{spend_program_id}.
 */
class RampGetSpendProgramSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_spend_program_single_resource';
    protected const DESCRIPTION = 'Fetch a spend program

Official Ramp endpoint: GET /developer/v1/spend-programs/{spend_program_id}';
    protected const PARAMETERS = array (
  'spend_program_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `spend_program_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/spend-programs/{spend_program_id}';
    protected const PATH_PARAMS = array (
  'spend_program_id' => 'spend_program_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
