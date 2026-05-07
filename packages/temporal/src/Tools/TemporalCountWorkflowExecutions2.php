<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Count workflow executions.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/workflow-count.
 */
class TemporalCountWorkflowExecutions2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_count_workflow_executions_2';
    protected const DESCRIPTION = 'Count workflow executions

Official Temporal endpoint: GET /namespaces/{namespace}/workflow-count

CountWorkflowExecutions is a visibility API to count of workflow executions in a specific namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'query' => array (
  'type' => 'string',
  'description' => 'query parameter.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/workflow-count';
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
