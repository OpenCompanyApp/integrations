<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe batch operation.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/batch-operations/{jobId}.
 */
class TemporalDescribeBatchOperation extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_batch_operation';
    protected const DESCRIPTION = 'Describe batch operation

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/batch-operations/{jobId}

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
    protected const PATH = '/api/v1/namespaces/{namespace}/batch-operations/{jobId}';
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
