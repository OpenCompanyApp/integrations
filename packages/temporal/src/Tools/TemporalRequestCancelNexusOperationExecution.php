<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Request cancel nexus operation execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/nexus-operations/{operationId}/cancel.
 */
class TemporalRequestCancelNexusOperationExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_request_cancel_nexus_operation_execution';
    protected const DESCRIPTION = 'Request cancel nexus operation execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/nexus-operations/{operationId}/cancel

RequestCancelNexusOperationExecution requests cancellation of a Nexus operation.

 Requesting to cancel an operation does not automatically transition the operation to canceled status.
 The operation will only transition to canceled status if it supports cancellation and the handler
 processes the cancellation request.';
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
    protected const PATH = '/api/v1/namespaces/{namespace}/nexus-operations/{operationId}/cancel';
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
