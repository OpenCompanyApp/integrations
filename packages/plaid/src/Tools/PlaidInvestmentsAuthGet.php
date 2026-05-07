<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get data needed to authorize an investments transfer.
 *
 * Maps to the official Plaid endpoint post /investments/auth/get.
 */
class PlaidInvestmentsAuthGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_investments_auth_get';
    protected const DESCRIPTION = 'Get data needed to authorize an investments transfer

Official Plaid endpoint: POST /investments/auth/get

The `/investments/auth/get` endpoint allows developers to receive user-authorized data to facilitate the transfer of holdings';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/investments/auth/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}