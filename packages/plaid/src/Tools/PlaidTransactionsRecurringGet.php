<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Fetch recurring transaction streams.
 *
 * Maps to the official Plaid endpoint post /transactions/recurring/get.
 */
class PlaidTransactionsRecurringGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_recurring_get';
    protected const DESCRIPTION = 'Fetch recurring transaction streams

Official Plaid endpoint: POST /transactions/recurring/get

The `/transactions/recurring/get` endpoint allows developers to receive a summary of the recurring outflow and inflow streams (expenses and deposits) from a user’s checking, savings or credit card accounts. Additionally, Plaid provides key insights about each recurring stream including the category, merchant, last amount, and more. Developers can use these insights to build tools and experiences that help their users better manage cash flow, monitor subscriptions, reduce spend, and stay on track with bill payments. This endpoint is offered as an add-on to Transactions. To request access to this endpoint, submit a [product access request](https://dashboard.plaid.com/team/products) or con...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transactions/recurring/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}