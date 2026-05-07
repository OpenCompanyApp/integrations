<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe batch operation.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/batch-operations/{jobId}.
 */
class TemporalDescribeBatchOperation2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_batch_operation_2';
    protected const DESCRIPTION = 'Describe batch operation

Official Temporal endpoint: GET /namespaces/{namespace}/batch-operations/{jobId}

DescribeBatchOperation returns the information about a batch operation';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/batch-operations/{jobId}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'jobId' => 'job_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
