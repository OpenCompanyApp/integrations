<?php

namespace OpenCompany\Integrations\GooglePubSub\Tools;

/**
 * Projects Topics Test Iam Permissions.
 *
 * Maps to the official Pub/Sub endpoint POST /v1/{+resource}:testIamPermissions.
 */
class GooglePubSubProjectsTopicsTestIamPermissions extends AbstractGooglePubSubTool
{
    protected const NAME = 'google_pubsub_projects_topics_test_iam_permissions';
    protected const DESCRIPTION = 'Projects Topics Test Iam Permissions

Official Pub/Sub endpoint: POST /v1/{+resource}:testIamPermissions
Returns permissions that a caller has on the specified resource. If the resource does not exist, this will return an empty set of permissions, not a `NOT_FOUND` error. Note: This operation is designed to be used for building permission-aware UIs and command-line tools, not for authorization checking. This operation may "fail open" without warning.';
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
    'description' => 'JSON request body matching the official Pub/Sub `TestIamPermissionsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+resource}:testIamPermissions';
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
