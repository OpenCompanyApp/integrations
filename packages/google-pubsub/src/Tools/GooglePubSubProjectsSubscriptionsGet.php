<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Get.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+subscription}.
 */
class GooglePubSubProjectsSubscriptionsGet extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_get';
    protected const DESCRIPTION = 'Projects Subscriptions Get

Official Pub/Sub endpoint: GET /v1/{+subscription}
Gets the configuration details of a subscription.';
    protected const PARAMETERS = array (
  'subscription' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `subscription`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
);
    protected const METHOD = 'GET';
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
