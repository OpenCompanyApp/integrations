<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Buildings Insert.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customer}/resources/buildings.
 */
class GoogleWorkspaceAdminResourcesBuildingsInsert extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_buildings_insert';
    protected const DESCRIPTION = 'Resources Buildings Insert

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customer}/resources/buildings
Inserts a building.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: coordinatesSource.',
  ),
  'coordinatesSource' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `coordinatesSource`.',
    'enum' =>
    array (
      0 => 'CLIENT_SPECIFIED',
      1 => 'RESOLVED_FROM_ADDRESS',
      2 => 'SOURCE_UNSPECIFIED',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Building` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/buildings';
    protected const PATH_PARAMS = array (
  0 => 'customer',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'coordinatesSource',
);
    protected const BODY_REQUIRED = true;
}