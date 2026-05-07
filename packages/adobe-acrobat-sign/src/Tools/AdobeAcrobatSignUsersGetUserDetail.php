<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves detailed information about the user in the caller account.
 *
 * Maps to the official Adobe Acrobat Sign endpoint get /users/{userId}.
 */
class AdobeAcrobatSignUsersGetUserDetail extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_users_get_user_detail';
    protected const DESCRIPTION = 'Retrieves detailed information about the user in the caller account.

Official Adobe Acrobat Sign endpoint: GET /users/{userId}

Retrieves detailed information about the user in the caller account.';
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
    protected const BODY_REQUIRED = false;
}
