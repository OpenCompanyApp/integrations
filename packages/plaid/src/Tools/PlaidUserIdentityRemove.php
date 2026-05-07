<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove user identity data.
 *
 * Maps to the official Plaid endpoint post /user/identity/remove.
 */
class PlaidUserIdentityRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_identity_remove';
    protected const DESCRIPTION = 'Remove user identity data

Official Plaid endpoint: POST /user/identity/remove

This endpoint allows customers to explicitly purge identity/PII data provided to Plaid for a given user. This is not exposed to customers by default, as it is meant for special scenarios or requests, but Plaid is obligated to enable customers to delete PII provided to us.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/identity/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}