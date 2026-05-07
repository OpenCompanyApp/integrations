<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List archived workflow executions.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/archived-workflows.
 */
class TemporalListArchivedWorkflowExecutions extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_archived_workflow_executions';
    protected const DESCRIPTION = 'List archived workflow executions

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/archived-workflows

ListArchivedWorkflowExecutions is a visibility API to list archived workflow executions in a specific namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'page_size' => array (
  'type' => 'integer',
  'description' => 'pageSize parameter.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'nextPageToken parameter.',
),
  'query' => array (
  'type' => 'string',
  'description' => 'query parameter.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/archived-workflows';
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
