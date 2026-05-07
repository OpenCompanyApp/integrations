<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Other Contacts List.
 *
 * Maps to the official People endpoint GET /v1/otherContacts.
 */
class GoogleContactsOtherContactsList extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_other_contacts_list';
    protected const DESCRIPTION = 'Other Contacts List

Official Google People endpoint: GET /v1/otherContacts
List all "Other contacts", that is contacts that are not in a contact group. "Other contacts" are typically auto created contacts from interactions. Sync tokens expire 7 days after the full sync. A request with an expired sync token will get an error with an [google.rpc.ErrorInfo](https://cloud.google.com/apis/design/errors#error_info) with reason "EXPIRED_SYNC_TOKEN". In the case of such an error clients should make a full sync request without a `sync_token`. The first page of a full sync request has an additional quota. If the quota is exceeded, a 429 error will be returned. This quota is fixed and can not be increased. When the `sync_token` is specified, resources deleted since the last sync will be returned as a person with `PersonMetadata.deleted` set to true. When the `page_token` or `sync_token` is specified, all other request parameters must match the first call. Writes may have a propagation delay of several minutes for sync requests. Incremental syncs are not intended for read-after-write use cases. See example usage at [List the user\'s other contacts that have changed](/people/v1/other-contacts#list_the_users_other_contacts_that_have_changed).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official People API method. Known keys: pageSize, sources, readMask, requestSyncToken, syncToken, pageToken.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The number of "Other contacts" to include in the response. Valid values are between 1 and 1000, inclusive. Defaults to 100 if not set or set to 0.',
  ),
  'sources' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Optional. A mask of what source types to return. Defaults to READ_SOURCE_TYPE_CONTACT if not set. Possible values for this field are: * READ_SOURCE_TYPE_CONTACT * READ_SOURCE_TYPE_CONTACT,READ_SOURCE_TYPE_PROFILE Specifying READ_SOURCE_TYPE_PROFILE without specifying READ_SOURCE_TYPE_CONTACT is not permitted.',
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
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. A field mask to restrict which fields on each person are returned. Multiple fields can be specified by separating them with commas. What values are valid depend on what ReadSourceType is used. If READ_SOURCE_TYPE_CONTACT is used, valid values are: * emailAddresses * metadata * names * phoneNumbers * photos If READ_SOURCE_TYPE_PROFILE is used, valid values are: * addresses * ageRanges * biographies * birthdays * calendarUrls * clientData * coverPhotos * emailAddresses * events * externalIds * genders * imClients * interests * locales * locations * memberships * metadata * miscKeywords * names * nicknames * occupations * organizations * phoneNumbers * photos * relations * sipAddresses * skills * urls * userDefined',
  ),
  'requestSyncToken' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Optional. Whether the response should return `next_sync_token` on the last page of results. It can be used to get incremental changes since the last request by setting it on the request `sync_token`. More details about sync behavior at `otherContacts.list`.',
  ),
  'syncToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A sync token, received from a previous response `next_sync_token` Provide this to retrieve only the resources changed since the last request. When syncing, all other parameters provided to `otherContacts.list` must match the first call that provided the sync token. More details about sync behavior at `otherContacts.list`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous response `next_page_token`. Provide this to retrieve the subsequent page. When paginating, all other parameters provided to `otherContacts.list` must match the first call that provided the page token.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/otherContacts';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'sources',
  2 => 'readMask',
  3 => 'requestSyncToken',
  4 => 'syncToken',
  5 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
