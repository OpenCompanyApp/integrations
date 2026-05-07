<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Detach.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+subscription}:detach.
 */
class GooglePubSubProjectsSubscriptionsDetach extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_detach';
    protected const DESCRIPTION = 'Projects Subscriptions Detach

Official Pub/Sub endpoint: POST /v1/{+subscription}:detach
Detaches a subscription from this topic. All messages retained in the subscription are dropped. Subsequent `Pull` and `StreamingPull` requests will return FAILED_PRECONDITION. If the subscription is a push subscription, pushes to the endpoint will stop.';
    protected const PARAMETERS = array (
  'subscription' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `subscription`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+subscription}:detach';
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
