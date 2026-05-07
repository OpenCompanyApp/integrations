<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Creates a new end customer for a Plaid reseller..
 *
 * Maps to the official Plaid endpoint post /beta/partner/customer/v1/create.
 */
class PlaidBetaPartnerCustomerV1Create extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beta_partner_customer_v1_create';
    protected const DESCRIPTION = 'Creates a new end customer for a Plaid reseller.

Official Plaid endpoint: POST /beta/partner/customer/v1/create

The `/beta/partner/customer/v1/create` endpoint creates a new end customer record. You can provide as much information as you have available. If any required information is missing for the products you intend to use, it will be listed in the `requirements_due` field of the response.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/partner/customer/v1/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}