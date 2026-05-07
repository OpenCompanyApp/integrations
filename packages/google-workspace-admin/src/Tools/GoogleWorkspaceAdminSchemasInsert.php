<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Schemas Insert.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customerId}/schemas.
 */
class GoogleWorkspaceAdminSchemasInsert extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_schemas_insert';
    protected const DESCRIPTION = 'Schemas Insert

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customerId}/schemas
Creates a schema.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Schema` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/schemas';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}