<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List workflow rules.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/workflow-rules.
 */
class TemporalListWorkflowRules extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_workflow_rules';
    protected const DESCRIPTION = 'List workflow rules

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/workflow-rules

Return all namespace workflow rules';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'nextPageToken parameter.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/workflow-rules';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'nextPageToken' => 'next_page_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
