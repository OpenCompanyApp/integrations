<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete an authorized application.
 *
 * Maps to the official WorkOS endpoint delete /user_management/users/{user_id}/authorized_applications/{application_id}.
 */
class WorkOSAuthorizedApplicationsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorized_applications_delete';
    protected const DESCRIPTION = 'Delete an authorized application

Official WorkOS endpoint: DELETE /user_management/users/{user_id}/authorized_applications/{application_id}

Delete an existing Authorized Connect Application.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official WorkOS API operation.',
  ),
  'application_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `application_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/user_management/users/{user_id}/authorized_applications/{application_id}';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
  'application_id' => 'application_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
