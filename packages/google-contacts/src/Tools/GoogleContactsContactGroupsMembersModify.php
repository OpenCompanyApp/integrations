<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

/**
 * Contact Groups Members Modify.
 *
 * Maps to the official People endpoint POST /v1/{+resourceName}/members:modify.
 */
class GoogleContactsContactGroupsMembersModify extends AbstractGoogleContactsTool
{
    protected const NAME = 'google_contacts_contact_groups_members_modify';
    protected const DESCRIPTION = 'Contact Groups Members Modify

Official Google People endpoint: POST /v1/{+resourceName}/members:modify
Modify the members of a contact group owned by the authenticated user. The only system contact groups that can have members added are `contactGroups/myContacts` and `contactGroups/starred`. Other system contact groups are deprecated and can only have contacts removed.';
    protected const PARAMETERS = array (
  'resourceName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceName` from the official People API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official People API `ModifyContactGroupMembersRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+resourceName}/members:modify';
    protected const PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resourceName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
