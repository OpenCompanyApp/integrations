<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe worker.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/workers/describe/{workerInstanceKey}.
 */
class TemporalDescribeWorker2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_worker_2';
    protected const DESCRIPTION = 'Describe worker

Official Temporal endpoint: GET /namespaces/{namespace}/workers/describe/{workerInstanceKey}

DescribeWorker returns information about the specified worker.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace this worker belongs to.',
  'required' => true,
),
  'worker_instance_key' => array (
  'type' => 'string',
  'description' => 'Worker instance key to describe.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/workers/describe/{workerInstanceKey}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'workerInstanceKey' => 'worker_instance_key',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
