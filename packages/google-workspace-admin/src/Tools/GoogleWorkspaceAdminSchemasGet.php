<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Schemas Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}.
 */
class GoogleWorkspaceAdminSchemasGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_schemas_get';
    protected const DESCRIPTION = 'Schemas Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}
Retrieves a schema.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'schemaKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `schemaKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/schemas/{schemaKey}';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'schemaKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}