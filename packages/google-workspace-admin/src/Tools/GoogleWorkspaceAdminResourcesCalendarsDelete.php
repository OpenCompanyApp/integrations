<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Calendars Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}.
 */
class GoogleWorkspaceAdminResourcesCalendarsDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_calendars_delete';
    protected const DESCRIPTION = 'Resources Calendars Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}
Deletes a calendar resource.';
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
    protected const METHOD = 'DELETE';
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