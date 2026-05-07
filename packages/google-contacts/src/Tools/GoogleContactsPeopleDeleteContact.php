<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Delete Contact.
 *
 * Maps to the official People endpoint DELETE /v1/{+resourceName}:deleteContact.
 */
class GoogleContactsPeopleDeleteContact extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_delete_contact';
    protected const DESCRIPTION = 'People Delete Contact

Official Google People endpoint: DELETE /v1/{+resourceName}:deleteContact
Delete a contact person. Any non-contact data will not be deleted. Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
    protected const PARAMETERS = array (
  'resourceName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceName` from the official People API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+resourceName}:deleteContact';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
