<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Removes a Plaid reseller's end customer..
 *
 * Maps to the official Plaid endpoint post /partner/customer/remove.
 */
class PlaidPartnerCustomerRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_partner_customer_remove';
    protected const DESCRIPTION = 'Removes a Plaid reseller\'s end customer.

Official Plaid endpoint: POST /partner/customer/remove

The `/partner/customer/remove` endpoint is used by reseller partners to remove an end customer. Removing an end customer will remove it from view in the Plaid Dashboard and deactivate its API keys. This endpoint can only be used to remove an end customer that has not yet been enabled in full Production.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/partner/customer/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}