<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove an Item.
 *
 * Maps to the official Plaid endpoint post /item/remove.
 */
class PlaidItemRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_remove';
    protected const DESCRIPTION = 'Remove an Item

Official Plaid endpoint: POST /item/remove

The `/item/remove` endpoint allows you to remove an Item. Once removed, the `access_token`, as well as any processor tokens or bank account tokens associated with the Item, is no longer valid and cannot be used to access any data that was associated with the Item. Calling `/item/remove` is a recommended best practice when offboarding users or if a user chooses to disconnect an account linked via Plaid. For subscription products, such as Transactions, Liabilities, and Investments, calling `/item/remove` is required to end subscription billing for the Item, unless the end user revoked permission (e.g. via [https://my.plaid.com/](https://my.plaid.com/)). For more details, see [Subscription f...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}