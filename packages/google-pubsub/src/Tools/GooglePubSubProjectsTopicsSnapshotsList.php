<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Snapshots List.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+topic}/snapshots.
 */
class GooglePubSubProjectsTopicsSnapshotsList extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_snapshots_list';
    protected const DESCRIPTION = 'Projects Topics Snapshots List

Official Pub/Sub endpoint: GET /v1/{+topic}/snapshots
Lists the names of the snapshots on this topic. Snapshots are used in [Seek](https://cloud.google.com/pubsub/docs/replay-overview) operations, which allow you to manage message acknowledgments in bulk. That is, you can set the acknowledgment state of messages in an existing subscription to the state captured by a snapshot.';
    protected const PARAMETERS = array (
  'topic' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `topic`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: pageSize, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+topic}/snapshots';
    protected const PATH_PARAMS = array (
  0 => 'topic',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'topic',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
