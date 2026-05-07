<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Contact Groups Batch Get.
 *
 * Maps to the official People endpoint GET /v1/contactGroups:batchGet.
 */
class GoogleContactsContactGroupsBatchGet extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_contact_groups_batch_get';
    protected const DESCRIPTION = 'Contact Groups Batch Get

Official Google People endpoint: GET /v1/contactGroups:batchGet
Get a list of contact groups owned by the authenticated user by specifying a list of contact group resource names.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official People API method. Known keys: resourceNames, maxMembers, groupFields.',
  ),
  'resourceNames' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Required. The resource names of the contact groups to get. There is a maximum of 200 resource names.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'maxMembers' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. Specifies the maximum number of members to return for each group. Defaults to 0 if not set, which will return zero members.',
  ),
  'groupFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A field mask to restrict which fields on the group are returned. Defaults to `metadata`, `groupType`, `memberCount`, and `name` if not set or set to empty. Valid fields are: * clientData * groupType * memberCount * metadata * name',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/contactGroups:batchGet';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'resourceNames',
  1 => 'maxMembers',
  2 => 'groupFields',
);
    protected const BODY_REQUIRED = false;
}
