<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch blank canvas workflow nodes for a spend program.
 *
 * Maps to the official Ramp endpoint get /developer/v1/spend-programs/{spend_program_id}/workflow-nodes.
 */
class RampGetSpendProgramWorkflowNodesResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_spend_program_workflow_nodes_resource';
    protected const DESCRIPTION = 'Fetch blank canvas workflow nodes for a spend program

Official Ramp endpoint: GET /developer/v1/spend-programs/{spend_program_id}/workflow-nodes';
    protected const PARAMETERS = array (
  'spend_program_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `spend_program_id` from the official Ramp API operation.',
  ),
  'service_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `service_key` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/spend-programs/{spend_program_id}/workflow-nodes';
    protected const PATH_PARAMS = array (
  'spend_program_id' => 'spend_program_id',
);
    protected const QUERY_PARAMS = array (
  'service_key' => 'service_key',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
