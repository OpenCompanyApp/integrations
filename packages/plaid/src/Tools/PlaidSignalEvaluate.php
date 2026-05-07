<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Evaluate a planned ACH transaction.
 *
 * Maps to the official Plaid endpoint post /signal/evaluate.
 */
class PlaidSignalEvaluate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_signal_evaluate';
    protected const DESCRIPTION = 'Evaluate a planned ACH transaction

Official Plaid endpoint: POST /signal/evaluate

Use `/signal/evaluate` to evaluate a planned ACH transaction to get a return risk assessment and additional risk signals. Before using `/signal/evaluate`, you must first [create a ruleset](https://plaid.com/docs/signal/signal-rules/) in the Dashboard under [**Signal->Rules**](https://dashboard.plaid.com/signal/risk-profiles). `/signal/evaluate` can be used with either Signal Transaction Scores or the Balance product. Which product is used will be determined by the `ruleset_key` that you provide. For more details, see [Signal Rules](https://plaid.com/docs/signal/signal-rules/). Note: This request may have higher latency when using a Balance-only ruleset. This is because Plaid must communic...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/signal/evaluate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}