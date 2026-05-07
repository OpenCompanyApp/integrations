<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Subscriptions Get Iam Policy.
 *
 * Maps to the official Pub/Sub endpoint GET /v1/{+resource}:getIamPolicy.
 */
class GooglePubSubProjectsSubscriptionsGetIamPolicy extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_subscriptions_get_iam_policy';
    protected const DESCRIPTION = 'Projects Subscriptions Get Iam Policy

Official Pub/Sub endpoint: GET /v1/{+resource}:getIamPolicy
Gets the access control policy for a resource. Returns an empty policy if the resource exists and does not have a policy set.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Pub/Sub method. Known keys: options.requestedPolicyVersion.',
  ),
  'options.requestedPolicyVersion' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `options.requestedPolicyVersion`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+resource}:getIamPolicy';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
  0 => 'options.requestedPolicyVersion',
);
    protected const BODY_REQUIRED = false;
}
