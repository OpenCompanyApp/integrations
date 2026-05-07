<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Calendars Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}.
 */
class GoogleWorkspaceAdminResourcesCalendarsGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_calendars_get';
    protected const DESCRIPTION = 'Resources Calendars Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}
Retrieves a calendar resource.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'calendarResourceId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `calendarResourceId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'calendarResourceId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}