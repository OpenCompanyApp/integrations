<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Search Directory People.
 *
 * Maps to the official People endpoint GET /v1/people:searchDirectoryPeople.
 */
class GoogleContactsPeopleSearchDirectoryPeople extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_search_directory_people';
    protected const DESCRIPTION = 'People Search Directory People

Official Google People endpoint: GET /v1/people:searchDirectoryPeople
Provides a list of domain profiles and domain contacts in the authenticated user\'s domain directory that match the search query.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. Prefix query that matches fields in the person. Does NOT use the read_mask for determining what fields to match.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous response `next_page_token`. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to `SearchDirectoryPeople` must match the first call that provided the page token.',
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
    'description' => 'Optional. The number of people to include in the response. Valid values are between 1 and 500, inclusive. Defaults to 100 if not set or set to 0.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/people:searchDirectoryPeople';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'query',
  1 => 'pageToken',
  2 => 'readMask',
  3 => 'sources',
  4 => 'mergeSources',
  5 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
