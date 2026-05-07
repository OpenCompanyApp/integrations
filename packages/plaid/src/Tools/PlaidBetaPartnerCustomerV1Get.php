<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieves the details of a Plaid reseller's end customer..
 *
 * Maps to the official Plaid endpoint post /beta/partner/customer/v1/get.
 */
class PlaidBetaPartnerCustomerV1Get extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beta_partner_customer_v1_get';
    protected const DESCRIPTION = 'Retrieves the details of a Plaid reseller\'s end customer.

Official Plaid endpoint: POST /beta/partner/customer/v1/get

The `/beta/partner/customer/v1/get` endpoint is used by reseller partners to retrieve data about a single end customer.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/partner/customer/v1/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}