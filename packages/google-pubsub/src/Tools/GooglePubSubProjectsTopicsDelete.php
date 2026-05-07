<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Delete.
 *
 * Maps to the official Pub/Sub endpoint DELETE /v1/{+topic}.
 */
class GooglePubSubProjectsTopicsDelete extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_delete';
    protected const DESCRIPTION = 'Projects Topics Delete

Official Pub/Sub endpoint: DELETE /v1/{+topic}
Deletes the topic with the given name. Returns `NOT_FOUND` if the topic does not exist. After a topic is deleted, a new topic may be created with the same name; this is an entirely new topic with none of the old configuration or subscriptions. Existing subscriptions to this topic are not deleted, but their `topic` field is set to `_deleted-topic_`.';
    protected const PARAMETERS = array (
  'topic' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `topic`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+topic}';
    protected const PATH_PARAMS = array (
  0 => 'topic',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'topic',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
