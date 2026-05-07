<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Returns OAuth-institution registration information for a given end customer..
 *
 * Maps to the official Plaid endpoint post /partner/customer/oauth_institutions/get.
 */
class PlaidPartnerCustomerOauthInstitutionsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_partner_customer_oauth_institutions_get';
    protected const DESCRIPTION = 'Returns OAuth-institution registration information for a given end customer.

Official Plaid endpoint: POST /partner/customer/oauth_institutions/get

The `/partner/customer/oauth_institutions/get` endpoint is used by reseller partners to retrieve OAuth-institution registration information about a single end customer. To learn how to set up a webhook to listen to status update events, visit the [reseller documentation](https://plaid.com/docs/account/resellers/#enabling-end-customers).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/partner/customer/oauth_institutions/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}