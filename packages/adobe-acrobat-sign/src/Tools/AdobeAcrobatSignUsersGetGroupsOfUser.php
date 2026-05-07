<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the groups of the user.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /users/{userId}/groups.
 */
class AdobeAcrobatSignUsersGetGroupsOfUser extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_users_get_groups_of_user';
    protected const DESCRIPTION = 'Retrieves the groups of the user.

Official Adobe Acrobat Sign endpoint: GET /users/{userId}/groups

Retrieves the groups of the user.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To get the details for the token owner, UserId can be replaced by "me" without quotes.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/users/{userId}/groups';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
