<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Modify Ack Deadline.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+subscription}:modifyAckDeadline.
 */
class GooglePubSubProjectsSubscriptionsModifyAckDeadline extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_modify_ack_deadline';
    protected const DESCRIPTION = 'Projects Subscriptions Modify Ack Deadline

Official Pub/Sub endpoint: POST /v1/{+subscription}:modifyAckDeadline
Modifies the ack deadline for a specific message. This method is useful to indicate that more time is needed to process a message by the subscriber, or to make the message available for redelivery if the processing was interrupted. Note that this does not modify the subscription-level `ackDeadlineSeconds` used for subsequent messages.';
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
    'description' => 'JSON request body matching the official Pub/Sub `ModifyAckDeadlineRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+subscription}:modifyAckDeadline';
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
