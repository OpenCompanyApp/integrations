<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Snapshots Patch.
 *
 * Maps to the official Pub/Sub endpoint PATCH /v1/{+name}.
 */
class GooglePubSubProjectsSnapshotsPatch extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_snapshots_patch';
    protected const DESCRIPTION = 'Projects Snapshots Patch

Official Pub/Sub endpoint: PATCH /v1/{+name}
Updates an existing snapshot by updating the fields specified in the update mask. Snapshots are used in [Seek](https://cloud.google.com/pubsub/docs/replay-overview) operations, which allow you to manage message acknowledgments in bulk. That is, you can set the acknowledgment state of messages in an existing subscription to the state captured by a snapshot.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Pub/Sub `UpdateSnapshotRequest` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
