<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Patch.
 *
 * Maps to the official Pub/Sub endpoint PATCH /v1/{+name}.
 */
class GooglePubSubProjectsSubscriptionsPatch extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_patch';
    protected const DESCRIPTION = 'Projects Subscriptions Patch

Official Pub/Sub endpoint: PATCH /v1/{+name}
Updates an existing subscription by updating the fields specified in the update mask. Note that certain properties of a subscription, such as its topic, are not modifiable.';
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
    'description' => 'JSON request body matching the official Pub/Sub `UpdateSubscriptionRequest` schema.',
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
