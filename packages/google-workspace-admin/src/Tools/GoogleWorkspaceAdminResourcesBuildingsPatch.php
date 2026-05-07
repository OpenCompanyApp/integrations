<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Buildings Patch.
 *
 * Maps to the official Workspace Admin endpoint PATCH /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}.
 */
class GoogleWorkspaceAdminResourcesBuildingsPatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_buildings_patch';
    protected const DESCRIPTION = 'Resources Buildings Patch

Official Workspace Admin endpoint: PATCH /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}
Patches a building.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'buildingId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `buildingId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'buildingId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'coordinatesSource',
);
    protected const BODY_REQUIRED = true;
}