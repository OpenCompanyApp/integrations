<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Contact Groups List.
 *
 * Maps to the official People endpoint GET /v1/contactGroups.
 */
class GoogleContactsContactGroupsList extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_contact_groups_list';
    protected const DESCRIPTION = 'Contact Groups List

Official Google People endpoint: GET /v1/contactGroups
List all contact groups owned by the authenticated user. Members of the contact groups are not populated.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official People API method. Known keys: syncToken, groupFields, pageSize, pageToken.',
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A sync token, returned by a previous call to `contactgroups.list`. Only resources changed since the sync token was created will be returned.',
  ),
  'groupFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A field mask to restrict which fields on the group are returned. Defaults to `metadata`, `groupType`, `memberCount`, and `name` if not set or set to empty. Valid fields are: * clientData * groupType * memberCount * metadata * name',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The maximum number of resources to return. Valid values are between 1 and 1000, inclusive. Defaults to 30 if not set or set to 0.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The next_page_token value returned from a previous call to [ListContactGroups](/people/api/rest/v1/contactgroups/list). Requests the next page of resources.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/contactGroups';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'syncToken',
  1 => 'groupFields',
  2 => 'pageSize',
  3 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
