<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe nexus operation execution.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/nexus-operations/{operationId}.
 */
class TemporalDescribeNexusOperationExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_nexus_operation_execution_2';
    protected const DESCRIPTION = 'Describe nexus operation execution

Official Temporal endpoint: GET /namespaces/{namespace}/nexus-operations/{operationId}

DescribeNexusOperationExecution returns information about a Nexus operation.
 Supported use cases include:
 - Get current operation info without waiting
 - Long-poll for next state change and return new operation info
 Response can optionally include operation input or outcome (if the operation has completed).';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'operation_id' => array (
  'type' => 'string',
  'description' => 'operationId parameter.',
  'required' => true,
),
  'run_id' => array (
  'type' => 'string',
  'description' => 'Operation run ID. If empty the request targets the latest run.',
),
  'include_input' => array (
  'type' => 'boolean',
  'description' => 'Include the input field in the response.',
),
  'include_outcome' => array (
  'type' => 'boolean',
  'description' => 'Include the outcome (result/failure) in the response if the operation has completed.',
),
  'long_poll_token' => array (
  'type' => 'string',
  'description' => 'Token from a previous DescribeNexusOperationExecutionResponse. If present, this RPC will long-poll until operation
 state changes from the state encoded in this token. If absent, return current state immediately.
 If present, run_id must also be present.
 Note that operation state may change multiple times between requests, therefore it is not
 guaranteed that a client making a sequence of long-poll requests will see a complete
 sequence of state changes.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/nexus-operations/{operationId}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'operationId' => 'operation_id',
);
    protected const QUERY_PARAMS = array (
  'runId' => 'run_id',
  'includeInput' => 'include_input',
  'includeOutcome' => 'include_outcome',
  'longPollToken' => 'long_poll_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
