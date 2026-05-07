<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Start batch operation.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/batch-operations/{jobId}.
 */
class TemporalStartBatchOperation2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_start_batch_operation_2';
    protected const DESCRIPTION = 'Start batch operation

Official Temporal endpoint: POST /namespaces/{namespace}/batch-operations/{jobId}

StartBatchOperation starts a new batch operation';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace that contains the batch operation',
  'required' => true,
),
  'job_id' => array (
  'type' => 'string',
  'description' => 'Job ID defines the unique ID for the batch job',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/batch-operations/{jobId}';
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
