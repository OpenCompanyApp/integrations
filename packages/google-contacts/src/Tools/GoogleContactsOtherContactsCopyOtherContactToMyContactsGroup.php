<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Other Contacts Copy Other Contact To My Contacts Group.
 *
 * Maps to the official People endpoint POST /v1/{+resourceName}:copyOtherContactToMyContactsGroup.
 */
class GoogleContactsOtherContactsCopyOtherContactToMyContactsGroup extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_other_contacts_copy_other_contact_to_my_contacts_group';
    protected const DESCRIPTION = 'Other Contacts Copy Other Contact To My Contacts Group

Official Google People endpoint: POST /v1/{+resourceName}:copyOtherContactToMyContactsGroup
Copies an "Other contact" to a new contact in the user\'s "myContacts" group Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
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
    'description' => 'JSON request body matching the official People API `CopyOtherContactToMyContactsGroupRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+resourceName}:copyOtherContactToMyContactsGroup';
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
