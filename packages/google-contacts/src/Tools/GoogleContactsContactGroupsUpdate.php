<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Contact Groups Update.
 *
 * Maps to the official People endpoint PUT /v1/{+resourceName}.
 */
class GoogleContactsContactGroupsUpdate extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_contact_groups_update';
    protected const DESCRIPTION = 'Contact Groups Update

Official Google People endpoint: PUT /v1/{+resourceName}
Update the name of an existing contact group owned by the authenticated user. Updated contact group names must be unique to the users contact groups. Attempting to create a group with a duplicate name will return a HTTP 409 error. Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
    protected const PARAMETERS = array (
  'resourceName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceName` from the official People API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official People API `UpdateContactGroupRequest` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/{+resourceName}';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
