<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List batch operations.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/batch-operations.
 */
class TemporalListBatchOperations2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_batch_operations_2';
    protected const DESCRIPTION = 'List batch operations

Official Temporal endpoint: GET /namespaces/{namespace}/batch-operations

ListBatchOperations returns a list of batch operations';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace that contains the batch operation',
  'required' => true,
),
  'page_size' => array (
  'type' => 'integer',
  'description' => 'List page size',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'Next page token',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/batch-operations';
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
