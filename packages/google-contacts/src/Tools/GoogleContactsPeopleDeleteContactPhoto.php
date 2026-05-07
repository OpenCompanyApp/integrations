<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Delete Contact Photo.
 *
 * Maps to the official People endpoint DELETE /v1/{+resourceName}:deleteContactPhoto.
 */
class GoogleContactsPeopleDeleteContactPhoto extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_delete_contact_photo';
    protected const DESCRIPTION = 'People Delete Contact Photo

Official Google People endpoint: DELETE /v1/{+resourceName}:deleteContactPhoto
Delete a contact\'s photo. Mutate requests for the same user should be done sequentially to avoid // lock contention.';
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
    'description' => 'Query string parameters accepted by the official People API method. Known keys: personFields, sources.',
  ),
  'personFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A field mask to restrict which fields on the person are returned. Multiple fields can be specified by separating them with commas. Defaults to empty if not set, which will skip the post mutate get. Valid values are: * addresses * ageRanges * biographies * birthdays * calendarUrls * clientData * coverPhotos * emailAddresses * events * externalIds * genders * imClients * interests * locales * locations * memberships * metadata * miscKeywords * names * nicknames * occupations * organizations * phoneNumbers * photos * relations * sipAddresses * skills * urls * userDefined',
  ),
  'sources' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Optional. A mask of what source types to return. Defaults to READ_SOURCE_TYPE_CONTACT and READ_SOURCE_TYPE_PROFILE if not set.',
    'enum' =>
    array (
      0 => 'READ_SOURCE_TYPE_UNSPECIFIED',
      1 => 'READ_SOURCE_TYPE_PROFILE',
      2 => 'READ_SOURCE_TYPE_CONTACT',
      3 => 'READ_SOURCE_TYPE_DOMAIN_CONTACT',
      4 => 'READ_SOURCE_TYPE_OTHER_CONTACT',
    ),
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+resourceName}:deleteContactPhoto';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
  0 => 'personFields',
  1 => 'sources',
);
    protected const BODY_REQUIRED = false;
}
