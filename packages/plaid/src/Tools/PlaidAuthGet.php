<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve auth data.
 *
 * Maps to the official Plaid endpoint post /auth/get.
 */
class PlaidAuthGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_auth_get';
    protected const DESCRIPTION = 'Retrieve auth data

Official Plaid endpoint: POST /auth/get

The `/auth/get` endpoint returns the bank account and bank identification numbers (such as routing numbers, for US accounts) associated with an Item\'s checking, savings, and cash management accounts, along with high-level account data and balances when available. Versioning note: In API version 2017-03-08, the schema of the `numbers` object returned by this endpoint is substantially different. For details, see [Plaid API versioning](https://plaid.com/docs/api/versioning/#version-2018-05-22).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/auth/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}