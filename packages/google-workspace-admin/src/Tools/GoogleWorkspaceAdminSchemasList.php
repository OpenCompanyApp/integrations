<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Schemas List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/schemas.
 */
class GoogleWorkspaceAdminSchemasList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_schemas_list';
    protected const DESCRIPTION = 'Schemas List

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/schemas
Retrieves all schemas for a customer.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/schemas';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}