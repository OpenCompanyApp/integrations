<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * (Deprecated) Get legacy categories.
 *
 * Maps to the official Plaid endpoint post /categories/get.
 */
class PlaidCategoriesGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_categories_get';
    protected const DESCRIPTION = '(Deprecated) Get legacy categories

Official Plaid endpoint: POST /categories/get

Send a request to the `/categories/get` endpoint to get detailed information on legacy categories returned by Plaid. This endpoint does not require authentication. All implementations are recommended to [use the newer `personal_finance_category` taxonomy](https://plaid.com/docs/transactions/pfc-migration/) instead of the legacy `category` taxonomy supported by this endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/categories/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}