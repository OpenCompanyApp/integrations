<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Record worker heartbeat.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/workers/heartbeat.
 */
class TemporalRecordWorkerHeartbeat extends AbstractTemporalTool
{
    protected const NAME = 'temporal_record_worker_heartbeat';
    protected const DESCRIPTION = 'Record worker heartbeat

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/workers/heartbeat

WorkerHeartbeat receive heartbeat request from the worker.';
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
    protected const PATH = '/api/v1/namespaces/{namespace}/workers/heartbeat';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
