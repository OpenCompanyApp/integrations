<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People List Directory People.
 *
 * Maps to the official People endpoint GET /v1/people:listDirectoryPeople.
 */
class GoogleContactsPeopleListDirectoryPeople extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_list_directory_people';
    protected const DESCRIPTION = 'People List Directory People

Official Google People endpoint: GET /v1/people:listDirectoryPeople
Provides a list of domain profiles and domain contacts in the authenticated user\'s domain directory. When the `sync_token` is specified, resources deleted since the last sync will be returned as a person with `PersonMetadata.deleted` set to true. When the `page_token` or `sync_token` is specified, all other request parameters must match the first call. Writes may have a propagation delay of several minutes for sync requests. Incremental syncs are not intended for read-after-write use cases. See example usage at [List the directory people that have changed](/people/v1/directory#list_the_directory_people_that_have_changed).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official People API method. Known keys: pageToken, readMask, sources, mergeSources, pageSize, syncToken, requestSyncToken.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous response `next_page_token`. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to `people.listDirectoryPeople` must match the first call that provided the page token.',
  ),
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. A field mask to restrict which fields on each person are returned. Multiple fields can be specified by separating them with commas. Valid values are: * addresses * ageRanges * biographies * birthdays * calendarUrls * clientData * coverPhotos * emailAddresses * events * externalIds * genders * imClients * interests * locales * locations * memberships * metadata * miscKeywords * names * nicknames * occupations * organizations * phoneNumbers * photos * relations * sipAddresses * skills * urls * userDefined',
  ),
  'sources' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Required. Directory sources to return.',
    'enum' =>
    array (
      0 => 'DIRECTORY_SOURCE_TYPE_UNSPECIFIED',
      1 => 'DIRECTORY_SOURCE_TYPE_DOMAIN_CONTACT',
      2 => 'DIRECTORY_SOURCE_TYPE_DOMAIN_PROFILE',
    ),
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'mergeSources' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Optional. Additional data to merge into the directory sources if they are connected through verified join keys such as email addresses or phone numbers.',
    'enum' =>
    array (
      0 => 'DIRECTORY_MERGE_SOURCE_TYPE_UNSPECIFIED',
      1 => 'DIRECTORY_MERGE_SOURCE_TYPE_CONTACT',
    ),
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The number of people to include in the response. Valid values are between 1 and 1000, inclusive. Defaults to 100 if not set or set to 0.',
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A sync token, received from a previous response `next_sync_token` Provide this to retrieve only the resources changed since the last request. When syncing, all other parameters provided to `people.listDirectoryPeople` must match the first call that provided the sync token. More details about sync behavior at `people.listDirectoryPeople`.',
  ),
  'requestSyncToken' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Optional. Whether the response should return `next_sync_token`. It can be used to get incremental changes since the last request by setting it on the request `sync_token`. More details about sync behavior at `people.listDirectoryPeople`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/people:listDirectoryPeople';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'readMask',
  2 => 'sources',
  3 => 'mergeSources',
  4 => 'pageSize',
  5 => 'syncToken',
  6 => 'requestSyncToken',
);
    protected const BODY_REQUIRED = false;
}
