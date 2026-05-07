<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Delete.
 *
 * Maps to the official Pub/Sub endpoint DELETE /v1/{+subscription}.
 */
class GooglePubSubProjectsSubscriptionsDelete extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_delete';
    protected const DESCRIPTION = 'Projects Subscriptions Delete

Official Pub/Sub endpoint: DELETE /v1/{+subscription}
Deletes an existing subscription. All messages retained in the subscription are immediately dropped. Calls to `Pull` after deletion will return `NOT_FOUND`. After a subscription is deleted, a new one may be created with the same name, but the new one has no association with the old subscription or its topic unless the same topic is specified.';
    protected const PARAMETERS = array (
  'subscription' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `subscription`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+subscription}';
    protected const PATH_PARAMS = array (
  0 => 'subscription',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'subscription',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
