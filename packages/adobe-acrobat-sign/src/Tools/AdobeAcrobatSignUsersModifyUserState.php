<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Activate/Deactivate a given user.
 *
 * Maps to the official Adobe Acrobat Sign endpoint put /users/{userId}/state.
 */
class AdobeAcrobatSignUsersModifyUserState extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_users_modify_user_state';
    protected const DESCRIPTION = 'Activate/Deactivate a given user.

Official Adobe Acrobat Sign endpoint: PUT /users/{userId}/state

Activate/Deactivate a given user.';
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
    'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To update the details for the token owner, UserId can be replaced by "me" without quotes.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => '',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/users/{userId}/state';
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
    protected const BODY_REQUIRED = true;
}
