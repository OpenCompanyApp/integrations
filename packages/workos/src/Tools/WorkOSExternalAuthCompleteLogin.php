<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Complete external authentication.
 *
 * Maps to the official WorkOS endpoint post /authkit/oauth2/complete.
 */
class WorkOSExternalAuthCompleteLogin extends AbstractWorkOSTool
{
    protected const NAME = 'workos_external_auth_complete_login';
    protected const DESCRIPTION = 'Complete external authentication

Official WorkOS endpoint: POST /authkit/oauth2/complete

Completes an external authentication flow and returns control to AuthKit. This endpoint is used with [Standalone Connect](/authkit/connect/standalone) to bridge your existing authentication system with the Connect OAuth API infrastructure. After successfully authenticating a user in your application, calling this endpoint will: - Create or update the user in AuthKit, using the given `id` as its `external_id`. - Return a `redirect_uri` your application should redirect to in order for AuthKit to complete the flow Users are automatically created or updated based on the `id` and `email` provided. If a user with the same `id` exists, their information is updated. Otherwise, a new user is creat...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/authkit/oauth2/complete';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
