<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Exchange the Link Correlation Id for a Link Token.
 *
 * Maps to the official Plaid endpoint post /link/oauth/correlation_id/exchange.
 */
class PlaidLinkOauthCorrelationIdExchange extends AbstractPlaidTool
{
    protected const NAME = 'plaid_link_oauth_correlation_id_exchange';
    protected const DESCRIPTION = 'Exchange the Link Correlation Id for a Link Token

Official Plaid endpoint: POST /link/oauth/correlation_id/exchange

Exchange an OAuth `link_correlation_id` for the corresponding `link_token`. The `link_correlation_id` is only available for `payment_initiation` products and is provided to the client via the OAuth `redirect_uri` as a query parameter. The `link_correlation_id` is ephemeral and expires in a brief period, after which it can no longer be exchanged for the `link_token`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/link/oauth/correlation_id/exchange';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}