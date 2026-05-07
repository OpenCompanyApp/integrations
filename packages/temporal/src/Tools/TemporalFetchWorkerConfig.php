<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Fetch worker config.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/workers/fetch-config.
 */
class TemporalFetchWorkerConfig extends AbstractTemporalTool
{
    protected const NAME = 'temporal_fetch_worker_config';
    protected const DESCRIPTION = 'Fetch worker config

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/workers/fetch-config

FetchWorkerConfig returns the worker configuration for a specific worker.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace this worker belongs to.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/workers/fetch-config';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
