<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Snapshots Get.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+snapshot}.
 */
class GooglePubSubProjectsSnapshotsGet extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_snapshots_get';
    protected const DESCRIPTION = 'Projects Snapshots Get

Official Pub/Sub endpoint: GET /v1/{+snapshot}
Gets the configuration details of a snapshot. Snapshots are used in [Seek](https://cloud.google.com/pubsub/docs/replay-overview) operations, which allow you to manage message acknowledgments in bulk. That is, you can set the acknowledgment state of messages in an existing subscription to the state captured by a snapshot.';
    protected const PARAMETERS = array (
  'snapshot' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `snapshot`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'GET';
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
