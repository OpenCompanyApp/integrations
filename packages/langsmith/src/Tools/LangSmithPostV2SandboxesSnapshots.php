<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a snapshot.
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/snapshots.
 */
class LangSmithPostV2SandboxesSnapshots extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_snapshots';
    protected const DESCRIPTION = 'Create a snapshot

Official endpoint: POST /v2/sandboxes/snapshots
Create a snapshot from a Docker image (async build).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sandboxes/snapshots';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
