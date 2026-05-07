<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Buildings Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}.
 */
class GoogleWorkspaceAdminResourcesBuildingsGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_buildings_get';
    protected const DESCRIPTION = 'Resources Buildings Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}
Retrieves a building.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/buildings/{buildingId}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'buildingId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}