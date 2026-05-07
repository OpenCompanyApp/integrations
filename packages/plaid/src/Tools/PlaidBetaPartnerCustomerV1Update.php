<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Updates an existing end customer..
 *
 * Maps to the official Plaid endpoint post /beta/partner/customer/v1/update.
 */
class PlaidBetaPartnerCustomerV1Update extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beta_partner_customer_v1_update';
    protected const DESCRIPTION = 'Updates an existing end customer.

Official Plaid endpoint: POST /beta/partner/customer/v1/update

The `/beta/partner/customer/v1/update` endpoint updates an existing end customer record.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/partner/customer/v1/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}