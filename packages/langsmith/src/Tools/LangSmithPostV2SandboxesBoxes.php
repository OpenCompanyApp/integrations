<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a sandbox claim.
 *
 * Maps to the official LangSmith endpoint POST /v2/sandboxes/boxes.
 */
class LangSmithPostV2SandboxesBoxes extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v2_sandboxes_boxes';
    protected const DESCRIPTION = 'Create a sandbox claim

Official endpoint: POST /v2/sandboxes/boxes
Create a new sandbox from a snapshot. The snapshot may be identified by `snapshot_id` (UUID) or by `snapshot_name` (tenant-scoped unique name); exactly one must be set.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sandboxes/boxes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
