<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Stop batch operation.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/batch-operations/{jobId}/stop.
 */
class TemporalStopBatchOperation extends AbstractTemporalTool
{
    protected const NAME = 'temporal_stop_batch_operation';
    protected const DESCRIPTION = 'Stop batch operation

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/batch-operations/{jobId}/stop

StopBatchOperation stops a batch operation';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace that contains the batch operation',
  'required' => true,
),
  'job_id' => array (
  'type' => 'string',
  'description' => 'Batch job id',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/batch-operations/{jobId}/stop';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'jobId' => 'job_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
