<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Batch Update Contacts.
 *
 * Maps to the official People endpoint POST /v1/people:batchUpdateContacts.
 */
class GoogleContactsPeopleBatchUpdateContacts extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_batch_update_contacts';
    protected const DESCRIPTION = 'People Batch Update Contacts

Official Google People endpoint: POST /v1/people:batchUpdateContacts
Update a batch of contacts and return a map of resource names to PersonResponses for the updated contacts. Mutate requests for the same user should be sent sequentially to avoid increased latency and failures.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official People API `BatchUpdateContactsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/people:batchUpdateContacts';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
