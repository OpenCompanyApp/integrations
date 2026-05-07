<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Get.
 *
 * Maps to the official People endpoint GET /v1/{+resourceName}.
 */
class GoogleContactsPeopleGet extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_get';
    protected const DESCRIPTION = 'People Get

Official Google People endpoint: GET /v1/{+resourceName}
Provides information about a person by specifying a resource name. Use `people/me` to indicate the authenticated user. The request returns a 400 error if \'personFields\' is not specified.';
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
    'description' => 'Query string parameters accepted by the official People API method. Known keys: requestMask.includeField, personFields, sources.',
  ),
  'requestMask.includeField' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. Comma-separated list of person fields to be included in the response. Each path should start with `person.`: for example, `person.names` or `person.photos`.',
  ),
  'personFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. A field mask to restrict which fields on the person are returned. Multiple fields can be specified by separating them with commas. Valid values are: * addresses * ageRanges * biographies * birthdays * calendarUrls * clientData * coverPhotos * emailAddresses * events * externalIds * genders * imClients * interests * locales * locations * memberships * metadata * miscKeywords * names * nicknames * occupations * organizations * phoneNumbers * photos * relations * sipAddresses * skills * urls * userDefined',
  ),
  'sources' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Optional. A mask of what source types to return. Defaults to READ_SOURCE_TYPE_PROFILE and READ_SOURCE_TYPE_CONTACT if not set.',
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
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+resourceName}';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
  0 => 'requestMask.includeField',
  1 => 'personFields',
  2 => 'sources',
);
    protected const BODY_REQUIRED = false;
}
