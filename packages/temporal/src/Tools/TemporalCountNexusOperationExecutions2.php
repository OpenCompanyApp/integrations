<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Count nexus operation executions.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/nexus-operation-count.
 */
class TemporalCountNexusOperationExecutions2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_count_nexus_operation_executions_2';
    protected const DESCRIPTION = 'Count nexus operation executions

Official Temporal endpoint: GET /namespaces/{namespace}/nexus-operation-count

CountNexusOperationExecutions is a visibility API to count Nexus operations in a specific namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'query' => array (
  'type' => 'string',
  'description' => 'Visibility query, see https://docs.temporal.io/list-filter for the syntax.
 See also ListNexusOperationExecutionsRequest for search attributes available for Nexus operations.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/nexus-operation-count';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
