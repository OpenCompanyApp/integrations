<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Returns a Plaid reseller's end customer..
 *
 * Maps to the official Plaid endpoint post /partner/customer/get.
 */
class PlaidPartnerCustomerGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_partner_customer_get';
    protected const DESCRIPTION = 'Returns a Plaid reseller\'s end customer.

Official Plaid endpoint: POST /partner/customer/get

The `/partner/customer/get` endpoint is used by reseller partners to retrieve data about a single end customer.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/partner/customer/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}