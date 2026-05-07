<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Legacy Update Examples.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/examples/bulk.
 */
class LangSmithLegacyUpdateExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_legacy_update_examples';
    protected const DESCRIPTION = 'Legacy Update Examples

Official endpoint: PATCH /api/v1/examples/bulk
Legacy update examples in bulk. For update involving attachments, use PATCH /v1/platform/datasets/{dataset_id}/examples instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/examples/bulk';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
