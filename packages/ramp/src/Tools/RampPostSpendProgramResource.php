<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a spend program.
 *
 * Maps to the official Ramp endpoint post /developer/v1/spend-programs.
 */
class RampPostSpendProgramResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_spend_program_resource';
    protected const DESCRIPTION = 'Create a spend program

Official Ramp endpoint: POST /developer/v1/spend-programs';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/spend-programs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
