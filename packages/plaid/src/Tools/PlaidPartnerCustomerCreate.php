<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Creates a new end customer for a Plaid reseller..
 *
 * Maps to the official Plaid endpoint post /partner/customer/create.
 */
class PlaidPartnerCustomerCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_partner_customer_create';
    protected const DESCRIPTION = 'Creates a new end customer for a Plaid reseller.

Official Plaid endpoint: POST /partner/customer/create

The `/partner/customer/create` endpoint is used by reseller partners to create end customers. To create end customers, it should be called in the Production environment only, even when creating Sandbox API keys. If called in the Sandbox environment, it will return a sample response, but no customer will be created and the API keys will not be valid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/partner/customer/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}