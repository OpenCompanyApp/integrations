<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List activity executions.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/activities.
 */
class TemporalListActivityExecutions2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_activity_executions_2';
    protected const DESCRIPTION = 'List activity executions

Official Temporal endpoint: GET /namespaces/{namespace}/activities

ListActivityExecutions is a visibility API to list activity executions in a specific namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'page_size' => array (
  'type' => 'integer',
  'description' => 'Max number of executions to return per page.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'Token returned in ListActivityExecutionsResponse.',
),
  'query' => array (
  'type' => 'string',
  'description' => 'Visibility query, see https://docs.temporal.io/list-filter for the syntax.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/activities';
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
