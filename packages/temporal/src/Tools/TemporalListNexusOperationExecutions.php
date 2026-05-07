<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List nexus operation executions.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/nexus-operations.
 */
class TemporalListNexusOperationExecutions extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_nexus_operation_executions';
    protected const DESCRIPTION = 'List nexus operation executions

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/nexus-operations

ListNexusOperationExecutions is a visibility API to list Nexus operations in a specific namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'page_size' => array (
  'type' => 'integer',
  'description' => 'Max number of operations to return per page.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'Token returned in ListNexusOperationExecutionsResponse.',
),
  'query' => array (
  'type' => 'string',
  'description' => 'Visibility query, see https://docs.temporal.io/list-filter for the syntax.
 Search attributes that are avaialble for Nexus operations include:
 - OperationId
 - RunId
 - Endpoint
 - Service
 - Operation
 - RequestId
 - StartTime
 - ExecutionTime
 - CloseTime
 - ExecutionStatus
 - ExecutionDuration
 - StateTransitionCount',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/nexus-operations';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pageSize' => 'page_size',
  'nextPageToken' => 'next_page_token',
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
