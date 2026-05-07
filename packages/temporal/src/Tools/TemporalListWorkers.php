<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List workers.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/workers.
 */
class TemporalListWorkers extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_workers';
    protected const DESCRIPTION = 'List workers

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/workers

ListWorkers is a visibility API to list worker status information in a specific namespace.';
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
  'description' => '`query` in ListWorkers is used to filter workers based on worker attributes.
 Supported attributes:
* WorkerInstanceKey
* WorkerIdentity
* HostName
* TaskQueue
* DeploymentName
* BuildId
* SdkName
* SdkVersion
* StartTime
* Status',
),
  'include_system_workers' => array (
  'type' => 'boolean',
  'description' => 'When true, the response will include system workers that are created implicitly
 by the server and not by the user. By default, system workers are excluded.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/workers';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pageSize' => 'page_size',
  'nextPageToken' => 'next_page_token',
  'query' => 'query',
  'includeSystemWorkers' => 'include_system_workers',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
