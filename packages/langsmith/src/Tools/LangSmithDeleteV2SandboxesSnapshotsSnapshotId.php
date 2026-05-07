<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a snapshot.
 *
 * Maps to the official LangSmith endpoint DELETE /v2/sandboxes/snapshots/{snapshot_id}.
 */
class LangSmithDeleteV2SandboxesSnapshotsSnapshotId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v2_sandboxes_snapshots_snapshot_id';
    protected const DESCRIPTION = 'Delete a snapshot

Official endpoint: DELETE /v2/sandboxes/snapshots/{snapshot_id}
Delete a snapshot by ID. The underlying storage is reclaimed asynchronously.';
    protected const PARAMETERS = array (
  'snapshot_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `snapshot_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/sandboxes/snapshots/{snapshot_id}';
    protected const PATH_PARAMS = array (
  0 => 'snapshot_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
