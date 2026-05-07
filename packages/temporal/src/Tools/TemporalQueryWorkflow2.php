<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Query workflow.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workflows/{execution.workflow_id}/query/{query.query_type}.
 */
class TemporalQueryWorkflow2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_query_workflow_2';
    protected const DESCRIPTION = 'Query workflow

Official Temporal endpoint: POST /namespaces/{namespace}/workflows/{execution.workflow_id}/query/{query.query_type}

QueryWorkflow requests a query be executed for a specified workflow execution.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'execution_workflow_id' => array (
  'type' => 'string',
  'description' => 'execution.workflow_id parameter.',
  'required' => true,
),
  'query_query_type' => array (
  'type' => 'string',
  'description' => 'query.query_type parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/workflows/{execution.workflow_id}/query/{query.query_type}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'execution.workflow_id' => 'execution_workflow_id',
  'query.query_type' => 'query_query_type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
