<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Resources Calendars Insert.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customer}/resources/calendars.
 */
class GoogleWorkspaceAdminResourcesCalendarsInsert extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_resources_calendars_insert';
    protected const DESCRIPTION = 'Resources Calendars Insert

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customer}/resources/calendars
Inserts a calendar resource.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `CalendarResource` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customer}/resources/calendars';
    protected const PATH_PARAMS = array (
  0 => 'customer',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}