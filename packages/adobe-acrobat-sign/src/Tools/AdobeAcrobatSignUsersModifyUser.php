<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Update an user.
 *
 * Maps to the official Adobe Acrobat Sign endpoint put /users/{userId}.
 */
class AdobeAcrobatSignUsersModifyUser extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_users_modify_user';
    protected const DESCRIPTION = 'Update an user.

Official Adobe Acrobat Sign endpoint: PUT /users/{userId}

Update an user.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The user identifier, as provided by GET /users or POST /users',
  ),
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Information necessary to update a user.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/users/{userId}';
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
