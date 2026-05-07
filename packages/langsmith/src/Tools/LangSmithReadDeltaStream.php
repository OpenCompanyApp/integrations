<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Delta Stream.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/{dataset_id}/runs/delta/stream.
 */
class LangSmithReadDeltaStream extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_delta_stream';
    protected const DESCRIPTION = 'Read Delta Stream

Official endpoint: POST /api/v1/datasets/{dataset_id}/runs/delta/stream
Stream feedback deltas for multiple feedback keys. Returns results in chunks as they become available. Each chunk contains results for one or more feedback keys. Errors for individual chunks are included in the response rather than failing the entire operation. Response format (SSE): event: data data: {"feedback_deltas": {"key1": {session_id: {...}}, ...}, "errors": null} event: data data: {"feedback_deltas": {"ke...';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/{dataset_id}/runs/delta/stream';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
