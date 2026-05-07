<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Terminate nexus operation execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/nexus-operations/{operationId}/terminate.
 */
class TemporalTerminateNexusOperationExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_terminate_nexus_operation_execution_2';
    protected const DESCRIPTION = 'Terminate nexus operation execution

Official Temporal endpoint: POST /namespaces/{namespace}/nexus-operations/{operationId}/terminate

TerminateNexusOperationExecution terminates an existing Nexus operation immediately.

 Termination happens immediately and the operation handler cannot react to it. A terminated operation will have
 its outcome set to a failure with a termination reason.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/nexus-operations/{operationId}/terminate';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'operationId' => 'operation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
