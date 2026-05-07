<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Evaluate a planned ACH transaction.
 *
 * Maps to the official Plaid endpoint post /processor/signal/evaluate.
 */
class PlaidProcessorSignalEvaluate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_signal_evaluate';
    protected const DESCRIPTION = 'Evaluate a planned ACH transaction

Official Plaid endpoint: POST /processor/signal/evaluate

Use `/processor/signal/evaluate` to evaluate a planned ACH transaction to get a return risk assessment and additional risk signals. `/processor/signal/evaluate` uses Rulesets that are configured on the end customer\'s Dashboard and can be used with either the Signal Transaction Scores product or the Balance product. Which product is used will be determined by the `ruleset_key` that you provide. Note that only customer-configured rulesets work with this endpoint; as a processor partner, you cannot create or configure your own rulesets. For more details, see [Signal Rules](https://plaid.com/docs/signal/signal-rules/). Note: This request may have higher latency if Signal Transaction Scores is...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/signal/evaluate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}