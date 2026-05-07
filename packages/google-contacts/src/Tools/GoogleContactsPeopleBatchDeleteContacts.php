<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Batch Delete Contacts.
 *
 * Maps to the official People endpoint POST /v1/people:batchDeleteContacts.
 */
class GoogleContactsPeopleBatchDeleteContacts extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_batch_delete_contacts';
    protected const DESCRIPTION = 'People Batch Delete Contacts

Official Google People endpoint: POST /v1/people:batchDeleteContacts
Delete a batch of contacts. Any non-contact data will not be deleted. Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official People API `BatchDeleteContactsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/people:batchDeleteContacts';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
