<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Enables a Plaid reseller's end customer in the Production environment..
 *
 * Maps to the official Plaid endpoint post /partner/customer/enable.
 */
class PlaidPartnerCustomerEnable extends AbstractPlaidTool
{
    protected const NAME = 'plaid_partner_customer_enable';
    protected const DESCRIPTION = 'Enables a Plaid reseller\'s end customer in the Production environment.

Official Plaid endpoint: POST /partner/customer/enable

The `/partner/customer/enable` endpoint is used by reseller partners to enable an end customer in the full Production environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/partner/customer/enable';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}