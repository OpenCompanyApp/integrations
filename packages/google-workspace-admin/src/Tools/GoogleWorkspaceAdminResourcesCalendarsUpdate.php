<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Calendars Update.
 *
 * Maps to the official Workspace Admin endpoint PUT /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}.
 */
class GoogleWorkspaceAdminResourcesCalendarsUpdate extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_calendars_update';
    protected const DESCRIPTION = 'Resources Calendars Update

Official Workspace Admin endpoint: PUT /admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}
Updates a calendar resource.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `CalendarResource` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/calendars/{calendarResourceId}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'calendarResourceId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}