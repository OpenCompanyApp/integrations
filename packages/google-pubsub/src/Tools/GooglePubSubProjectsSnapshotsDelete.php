<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Snapshots Delete.
 *
 * Maps to the official Pub/Sub endpoint DELETE /v1/{+snapshot}.
 */
class GooglePubSubProjectsSnapshotsDelete extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_snapshots_delete';
    protected const DESCRIPTION = 'Projects Snapshots Delete

Official Pub/Sub endpoint: DELETE /v1/{+snapshot}
Removes an existing snapshot. Snapshots are used in [Seek] (https://cloud.google.com/pubsub/docs/replay-overview) operations, which allow you to manage message acknowledgments in bulk. That is, you can set the acknowledgment state of messages in an existing subscription to the state captured by a snapshot. When the snapshot is deleted, all messages retained in the snapshot are immediately dropped. After a snapshot is deleted, a new one may be created with the same name, but the new one has no association with the old snapshot or its subscription, unless the same subscription is specified.';
    protected const PARAMETERS = array (
  'snapshot' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `snapshot`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+snapshot}';
    protected const PATH_PARAMS = array (
  0 => 'snapshot',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'snapshot',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
