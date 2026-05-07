<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Set Iam Policy.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+resource}:setIamPolicy.
 */
class GooglePubSubProjectsTopicsSetIamPolicy extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_set_iam_policy';
    protected const DESCRIPTION = 'Projects Topics Set Iam Policy

Official Pub/Sub endpoint: POST /v1/{+resource}:setIamPolicy
Sets the access control policy on the specified resource. Replaces any existing policy. Can return `NOT_FOUND`, `INVALID_ARGUMENT`, and `PERMISSION_DENIED` errors.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`. Use full Pub/Sub resource names such as `projects/example/topics/events`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Pub/Sub `SetIamPolicyRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+resource}:setIamPolicy';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
