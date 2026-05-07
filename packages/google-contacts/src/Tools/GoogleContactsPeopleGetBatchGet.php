<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Get Batch Get.
 *
 * Maps to the official People endpoint GET /v1/people:batchGet.
 */
class GoogleContactsPeopleGetBatchGet extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_get_batch_get';
    protected const DESCRIPTION = 'People Get Batch Get

Official Google People endpoint: GET /v1/people:batchGet
Provides information about a list of specific people by specifying a list of requested resource names. Use `people/me` to indicate the authenticated user. The request returns a 400 error if \'personFields\' is not specified.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official People API method. Known keys: personFields, resourceNames, requestMask.includeField, sources.',
  ),
  'personFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. A field mask to restrict which fields on each person are returned. Multiple fields can be specified by separating them with commas. Valid values are: * addresses * ageRanges * biographies * birthdays * calendarUrls * clientData * coverPhotos * emailAddresses * events * externalIds * genders * imClients * interests * locales * locations * memberships * metadata * miscKeywords * names * nicknames * occupations * organizations * phoneNumbers * photos * relations * sipAddresses * skills * urls * userDefined',
  ),
  'resourceNames' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Required. The resource names of the people to provide information about. It\'s repeatable. The URL query parameter should be resourceNames=&resourceNames=&... - To get information about the authenticated user, specify `people/me`. - To get information about a google account, specify `people/{account_id}`. - To get information about a contact, specify the resource name that identifies the contact as returned by `people.connections.list`. There is a maximum of 200 resource names.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'requestMask.includeField' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. Comma-separated list of person fields to be included in the response. Each path should start with `person.`: for example, `person.names` or `person.photos`.',
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
    protected const METHOD = 'GET';
    protected const PATH = '/v1/people:batchGet';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'personFields',
  1 => 'resourceNames',
  2 => 'requestMask.includeField',
  3 => 'sources',
);
    protected const BODY_REQUIRED = false;
}
