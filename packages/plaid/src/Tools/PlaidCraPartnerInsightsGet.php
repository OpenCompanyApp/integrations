<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve cash flow insights from the bank accounts used for income verification.
 *
 * Maps to the official Plaid endpoint post /cra/partner_insights/get.
 */
class PlaidCraPartnerInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_partner_insights_get';
    protected const DESCRIPTION = 'Retrieve cash flow insights from the bank accounts used for income verification

Official Plaid endpoint: POST /cra/partner_insights/get

`/cra/partner_insights/get` returns cash flow insights for a specified user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/partner_insights/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}