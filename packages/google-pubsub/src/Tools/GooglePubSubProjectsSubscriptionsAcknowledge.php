<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Acknowledge.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+subscription}:acknowledge.
 */
class GooglePubSubProjectsSubscriptionsAcknowledge extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_acknowledge';
    protected const DESCRIPTION = 'Projects Subscriptions Acknowledge

Official Pub/Sub endpoint: POST /v1/{+subscription}:acknowledge
Acknowledges the messages associated with the `ack_ids` in the `AcknowledgeRequest`. The Pub/Sub system can remove the relevant messages from the subscription. Acknowledging a message whose ack deadline has expired may succeed, but such a message may be redelivered later. Acknowledging a message more than once will not result in an error.';
    protected const PARAMETERS = array (
  'subscription' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `subscription`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Pub/Sub `AcknowledgeRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+subscription}:acknowledge';
    protected const PATH_PARAMS = array (
  0 => 'subscription',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'subscription',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
