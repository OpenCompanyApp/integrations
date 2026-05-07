<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List worker deployments.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/worker-deployments.
 */
class TemporalListWorkerDeployments extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_worker_deployments';
    protected const DESCRIPTION = 'List worker deployments

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/worker-deployments

Lists all Worker Deployments that are tracked in the Namespace.
 Experimental. This API might significantly change or be removed in a future release.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/worker-deployments';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pageSize' => 'page_size',
  'nextPageToken' => 'next_page_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
