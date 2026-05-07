<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a snapshot.
 *
 * Maps to the official LangSmith endpoint GET /v2/sandboxes/snapshots/{snapshot_id}.
 */
class LangSmithGetV2SandboxesSnapshotsSnapshotId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v2_sandboxes_snapshots_snapshot_id';
    protected const DESCRIPTION = 'Get a snapshot

Official endpoint: GET /v2/sandboxes/snapshots/{snapshot_id}
Get a sandbox snapshot by ID.';
    protected const PARAMETERS = array (
  'snapshot_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `snapshot_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v2/sandboxes/snapshots/{snapshot_id}';
    protected const PATH_PARAMS = array (
  0 => 'snapshot_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
