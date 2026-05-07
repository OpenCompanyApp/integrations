<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List providers.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{user_id}/data_providers.
 */
class WorkOSDataIntegrationsUserManagementGetUserDataIntegrations extends AbstractWorkOSTool
{
    protected const NAME = 'workos_data_integrations_user_management_get_user_data_integrations';
    protected const DESCRIPTION = 'List providers

Official WorkOS endpoint: GET /user_management/users/{user_id}/data_providers

Retrieves a list of available providers and the user\'s connection status for each. Returns all providers configured for your environment, along with the user\'s [connected account](/reference/pipes/connected-account) information where applicable.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official WorkOS API operation.',
  ),
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/users/{user_id}/data_providers';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'organization_id' => 'organization_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
