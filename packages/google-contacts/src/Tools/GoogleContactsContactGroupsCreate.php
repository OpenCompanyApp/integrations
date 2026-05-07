<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Contact Groups Create.
 *
 * Maps to the official People endpoint POST /v1/contactGroups.
 */
class GoogleContactsContactGroupsCreate extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_contact_groups_create';
    protected const DESCRIPTION = 'Contact Groups Create

Official Google People endpoint: POST /v1/contactGroups
Create a new contact group owned by the authenticated user. Created contact group names must be unique to the users contact groups. Attempting to create a group with a duplicate name will return a HTTP 409 error. Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official People API `CreateContactGroupRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/contactGroups';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
