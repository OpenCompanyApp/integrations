<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Pull.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+subscription}:pull.
 */
class GooglePubSubProjectsSubscriptionsPull extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_pull';
    protected const DESCRIPTION = 'Projects Subscriptions Pull

Official Pub/Sub endpoint: POST /v1/{+subscription}:pull
Pulls messages from the server.';
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
    'description' => 'JSON request body matching the official Pub/Sub `PullRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+subscription}:pull';
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
