<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Opt-in an Item to Signal Transaction Scores.
 *
 * Maps to the official Plaid endpoint post /signal/prepare.
 */
class PlaidSignalPrepare extends AbstractPlaidTool
{
    protected const NAME = 'plaid_signal_prepare';
    protected const DESCRIPTION = 'Opt-in an Item to Signal Transaction Scores

Official Plaid endpoint: POST /signal/prepare

When an Item is not initialized with `signal`, call `/signal/prepare` to opt-in that Item to the data collection process used to develop a Signal Transaction Score. This should be done on Items where `signal` was added in the `additional_consented_products` array but not in the `products`, `optional_products`, or `required_if_supported_products` array. If `/signal/prepare` is skipped on an Item that is not initialized with `signal`, the initial call to `/signal/evaluate` on that Item will be less accurate, because Plaid will have access to less data for computing the Signal Transaction Score. If your integration is purely Balance-only, this endpoint will have no effect, as Balance-only ru...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/signal/prepare';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}