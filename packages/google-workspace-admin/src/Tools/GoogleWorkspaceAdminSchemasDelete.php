<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Schemas Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}.
 */
class GoogleWorkspaceAdminSchemasDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_schemas_delete';
    protected const DESCRIPTION = 'Schemas Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customerId}/schemas/{schemaKey}
Deletes a schema.';
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
    protected const METHOD = 'DELETE';
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