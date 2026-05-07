<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Poll nexus operation execution.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/nexus-operations/{operationId}/poll.
 */
class TemporalPollNexusOperationExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_poll_nexus_operation_execution';
    protected const DESCRIPTION = 'Poll nexus operation execution

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/nexus-operations/{operationId}/poll

PollNexusOperationExecution long-polls for a Nexus operation for a given wait stage to complete and returns
 the outcome (result or failure).';
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
  'wait_stage' => array (
  'type' => 'string',
  'description' => 'Stage to wait for. The operation may be in a more advanced stage when the poll is unblocked.',
  'enum' => array (
  'NEXUS_OPERATION_WAIT_STAGE_UNSPECIFIED',
  'NEXUS_OPERATION_WAIT_STAGE_STARTED',
  'NEXUS_OPERATION_WAIT_STAGE_CLOSED',
),
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/nexus-operations/{operationId}/poll';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'operationId' => 'operation_id',
);
    protected const QUERY_PARAMS = array (
  'runId' => 'run_id',
  'waitStage' => 'wait_stage',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
