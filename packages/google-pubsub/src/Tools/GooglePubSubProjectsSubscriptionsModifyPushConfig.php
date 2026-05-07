<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Modify Push Config.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+subscription}:modifyPushConfig.
 */
class GooglePubSubProjectsSubscriptionsModifyPushConfig extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_modify_push_config';
    protected const DESCRIPTION = 'Projects Subscriptions Modify Push Config

Official Pub/Sub endpoint: POST /v1/{+subscription}:modifyPushConfig
Modifies the `PushConfig` for a specified subscription. This may be used to change a push subscription to a pull one (signified by an empty `PushConfig`) or vice versa, or change the endpoint URL and other attributes of a push subscription. Messages will accumulate for delivery continuously through the call regardless of changes to the `PushConfig`.';
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
    'description' => 'JSON request body matching the official Pub/Sub `ModifyPushConfigRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+subscription}:modifyPushConfig';
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
