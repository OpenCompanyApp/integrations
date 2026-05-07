<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Report fraud for an Item.
 *
 * Maps to the official Plaid endpoint post /item/handle_fraud_report.
 */
class PlaidItemHandleFraudReport extends AbstractPlaidTool
{
    protected const NAME = 'plaid_item_handle_fraud_report';
    protected const DESCRIPTION = 'Report fraud for an Item

Official Plaid endpoint: POST /item/handle_fraud_report

Use this endpoint to create a fraud report and terminate the associated Item. The `access_token` associated with the Item will be deactivated and billing for the Item\'s products will be ended. This endpoint allows you to report various types of fraud incidents including account takeovers, identity fraud, unauthorized transactions, and other security events. The reported data helps improve fraud detection models and provides valuable feedback to enhance the overall security of the Plaid network. Reports can be created for confirmed incidents that have been fully investigated, or for suspected incidents that require further review. You can associate reports with specific users, sessions, or...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/item/handle_fraud_report';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}