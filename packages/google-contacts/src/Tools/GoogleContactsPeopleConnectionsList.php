<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * People Connections List.
 *
 * Maps to the official People endpoint GET /v1/{+resourceName}/connections.
 */
class GoogleContactsPeopleConnectionsList extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_people_connections_list';
    protected const DESCRIPTION = 'People Connections List

Official Google People endpoint: GET /v1/{+resourceName}/connections
Provides a list of the authenticated user\'s contacts. Sync tokens expire 7 days after the full sync. A request with an expired sync token will get an error with an [google.rpc.ErrorInfo](https://cloud.google.com/apis/design/errors#error_info) with reason "EXPIRED_SYNC_TOKEN". In the case of such an error clients should make a full sync request without a `sync_token`. The first page of a full sync request has an additional quota. If the quota is exceeded, a 429 error will be returned. This quota is fixed and can not be increased. When the `sync_token` is specified, resources deleted since the last sync will be returned as a person with `PersonMetadata.deleted` set to true. When the `page_token` or `sync_token` is specified, all other request parameters must match the first call. Writes may have a propagation delay of several minutes for sync requests. Incremental syncs are not intended for read-after-write use cases. See example usage at [List the user\'s contacts that have changed](/people/v1/contacts#list_the_users_contacts_that_have_changed).';
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
    'description' => 'Query string parameters accepted by the official People API method. Known keys: sources, pageToken, requestMask.includeField, sortOrder, personFields, pageSize, syncToken, requestSyncToken.',
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
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous response `next_page_token`. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to `people.connections.list` must match the first call that provided the page token.',
  ),
  'requestMask.includeField' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. Comma-separated list of person fields to be included in the response. Each path should start with `person.`: for example, `person.names` or `person.photos`.',
  ),
  'sortOrder' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. The order in which the connections should be sorted. Defaults to `LAST_MODIFIED_ASCENDING`.',
    'enum' =>
    array (
      0 => 'LAST_MODIFIED_ASCENDING',
      1 => 'LAST_MODIFIED_DESCENDING',
      2 => 'FIRST_NAME_ASCENDING',
      3 => 'LAST_NAME_ASCENDING',
    ),
  ),
  'personFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. A field mask to restrict which fields on each person are returned. Multiple fields can be specified by separating them with commas. Valid values are: * addresses * ageRanges * biographies * birthdays * calendarUrls * clientData * coverPhotos * emailAddresses * events * externalIds * genders * imClients * interests * locales * locations * memberships * metadata * miscKeywords * names * nicknames * occupations * organizations * phoneNumbers * photos * relations * sipAddresses * skills * urls * userDefined',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The number of connections to include in the response. Valid values are between 1 and 1000, inclusive. Defaults to 100 if not set or set to 0.',
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A sync token, received from a previous response `next_sync_token` Provide this to retrieve only the resources changed since the last request. When syncing, all other parameters provided to `people.connections.list` must match the first call that provided the sync token. More details about sync behavior at `people.connections.list`.',
  ),
  'requestSyncToken' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Optional. Whether the response should return `next_sync_token` on the last page of results. It can be used to get incremental changes since the last request by setting it on the request `sync_token`. More details about sync behavior at `people.connections.list`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+resourceName}/connections';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
  0 => 'sources',
  1 => 'pageToken',
  2 => 'requestMask.includeField',
  3 => 'sortOrder',
  4 => 'personFields',
  5 => 'pageSize',
  6 => 'syncToken',
  7 => 'requestSyncToken',
);
    protected const BODY_REQUIRED = false;
}
