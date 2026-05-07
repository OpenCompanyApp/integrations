<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Ingest Runs (Batch JSON).
 *
 * Maps to the official LangSmith endpoint POST /runs/batch.
 */
class LangSmithPostRunsBatch extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_runs_batch';
    protected const DESCRIPTION = 'Ingest Runs (Batch JSON)

Official endpoint: POST /runs/batch
Ingests a batch of runs in a single JSON payload. The payload must have `post` and/or `patch` arrays containing run objects. Prefer this endpoint over single‑run ingestion when submitting hundreds of runs, but `/runs/multipart` offers better handling for very large fields and attachments.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/runs/batch';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
