<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign\Tools;

/**
 * Retrieves the URL of manage, account settings and user profile page.
 *
 * Maps to the official Adobe Acrobat Sign endpoint post /users/{userId}/views.
 */
class AdobeAcrobatSignUsersGetUserViews extends AbstractAdobeAcrobatSignTool
{
    protected const NAME = 'adobe_acrobat_sign_users_get_user_views';
    protected const DESCRIPTION = 'Retrieves the URL of manage, account settings and user profile page.

Official Adobe Acrobat Sign endpoint: POST /users/{userId}/views

Retrieves the URL of manage, account settings and user profile page.';
    protected const PARAMETERS = array (
  'x_api_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email of API caller using the account or group token in the format userid:{userId} OR email:{email}. If it is not specified, then the caller is inferred from the token.',
  ),
  'x_on_behalf_of_user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The userId or email in the format userid:{userId} OR email:{email}. of the user that has shared his/her account',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The user identifier, as returned by the user creation API or retrieved from the API to fetch users. To get the details for the token owner, UserId can be replaced by "me" without quotes.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Name of the required view and its desired configuration.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/users/{userId}/views';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'x-api-user' => 'x_api_user',
  'x-on-behalf-of-user' => 'x_on_behalf_of_user',
);
    protected const FORM_PARAMS = array (
);
    protected const FILE_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
