<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Contact Groups Get.
 *
 * Maps to the official People endpoint GET /v1/{+resourceName}.
 */
class GoogleContactsContactGroupsGet extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_contact_groups_get';
    protected const DESCRIPTION = 'Contact Groups Get

Official Google People endpoint: GET /v1/{+resourceName}
Get a specific contact group owned by the authenticated user by specifying a contact group resource name.';
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
    'description' => 'Query string parameters accepted by the official People API method. Known keys: maxMembers, groupFields.',
  ),
  'maxMembers' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. Specifies the maximum number of members to return. Defaults to 0 if not set, which will return zero members.',
  ),
  'groupFields' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A field mask to restrict which fields on the group are returned. Defaults to `metadata`, `groupType`, `memberCount`, and `name` if not set or set to empty. Valid fields are: * clientData * groupType * memberCount * metadata * name',
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
  0 => 'maxMembers',
  1 => 'groupFields',
);
    protected const BODY_REQUIRED = false;
}
