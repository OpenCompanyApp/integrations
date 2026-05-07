<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Update Contact Photo.
 *
 * Maps to the official People endpoint PATCH /v1/{+resourceName}:updateContactPhoto.
 */
class GoogleContactsPeopleUpdateContactPhoto extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_update_contact_photo';
    protected const DESCRIPTION = 'People Update Contact Photo

Official Google People endpoint: PATCH /v1/{+resourceName}:updateContactPhoto
Update a contact\'s photo. Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
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
    'description' => 'JSON request body matching the official People API `UpdateContactPhotoRequest` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/{+resourceName}:updateContactPhoto';
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
