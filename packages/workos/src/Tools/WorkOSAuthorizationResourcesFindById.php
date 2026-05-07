<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a resource.
 *
 * Maps to the official WorkOS endpoint get /authorization/resources/{resource_id}.
 */
class WorkOSAuthorizationResourcesFindById extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_find_by_id';
    protected const DESCRIPTION = 'Get a resource

Official WorkOS endpoint: GET /authorization/resources/{resource_id}

Retrieve the details of an authorization resource by its ID.';
    protected const PARAMETERS = array (
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/resources/{resource_id}';
    protected const PATH_PARAMS = array (
  'resource_id' => 'resource_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
