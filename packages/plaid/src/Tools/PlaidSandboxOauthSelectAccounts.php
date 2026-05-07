<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Save the selected accounts when connecting to the Platypus Oauth institution.
 *
 * Maps to the official Plaid endpoint post /sandbox/oauth/select_accounts.
 */
class PlaidSandboxOauthSelectAccounts extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_oauth_select_accounts';
    protected const DESCRIPTION = 'Save the selected accounts when connecting to the Platypus Oauth institution

Official Plaid endpoint: POST /sandbox/oauth/select_accounts

Save the selected accounts when connecting to the Platypus Oauth institution';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/oauth/select_accounts';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}