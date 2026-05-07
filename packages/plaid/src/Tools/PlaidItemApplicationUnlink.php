<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Unlink a user’s connected application.
 *
 * Maps to the official Plaid endpoint post /item/application/unlink.
 */
class PlaidItemApplicationUnlink extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_application_unlink';
    protected const DESCRIPTION = 'Unlink a user’s connected application

Official Plaid endpoint: POST /item/application/unlink

Unlink a user’s connected application. On an unlink request, Plaid will immediately revoke the Application’s access to the User’s data. The User will have to redo the OAuth authentication process in order to restore functionality. This endpoint only removes ongoing data access permissions, therefore the User will need to reach out to the Application itself in order to disable and delete their account and delete any data that the Application already received (if the Application does not do so by default). This endpoint should be called in real time as the User is unlinking an Application, and should not be batched in order to ensure that the change is reflected as soon as possible.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/application/unlink';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}