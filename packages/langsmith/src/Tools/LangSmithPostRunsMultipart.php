<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Ingest Runs (Multipart).
 *
 * Maps to the official LangSmith endpoint POST /runs/multipart.
 */
class LangSmithPostRunsMultipart extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_runs_multipart';
    protected const DESCRIPTION = 'Ingest Runs (Multipart)

Official endpoint: POST /runs/multipart
Ingests multiple runs, feedback objects, and binary attachments in a single `multipart/form-data` request. **Part‑name pattern**: `.[.]` where `event` ∈ {`post`, `patch`, `feedback`, `attachment`}. * `post|patch.` – JSON run payload. * `post|patch..` – out‑of‑band run data (`inputs`, `outputs`, `events`, `error`, `extra`, `serialized`). * `feedback.` – JSON feedback payload (must include `trace_id`)...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/runs/multipart';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
