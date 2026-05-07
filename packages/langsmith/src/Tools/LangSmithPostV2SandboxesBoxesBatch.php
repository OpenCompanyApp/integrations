<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Batch delete sandbox claims.
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/boxes/batch-delete.
 */
class LangSmithPostV2SandboxesBoxesBatch extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_boxes_batch';
    protected const DESCRIPTION = 'Batch delete sandbox claims

Official endpoint: POST /v2/sandboxes/boxes/batch-delete
Delete multiple sandbox claims by name or UUID in a single request.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sandboxes/boxes/batch-delete';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
