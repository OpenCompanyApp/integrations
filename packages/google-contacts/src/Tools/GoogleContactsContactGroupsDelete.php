<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Contact Groups Delete.
 *
 * Maps to the official People endpoint DELETE /v1/{+resourceName}.
 */
class GoogleContactsContactGroupsDelete extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_contact_groups_delete';
    protected const DESCRIPTION = 'Contact Groups Delete

Official Google People endpoint: DELETE /v1/{+resourceName}
Delete an existing contact group owned by the authenticated user by specifying a contact group resource name. Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
    protected const PARAMETERS = array (
  'resourceName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceName` from the official People API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official People API method. Known keys: deleteContacts.',
  ),
  'deleteContacts' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Optional. Set to true to also delete the contacts in the specified group.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+resourceName}';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
  0 => 'deleteContacts',
);
    protected const BODY_REQUIRED = false;
}
