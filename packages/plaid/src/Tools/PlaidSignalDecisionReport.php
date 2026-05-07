<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Report whether you initiated an ACH transaction.
 *
 * Maps to the official Plaid endpoint post /signal/decision/report.
 */
class PlaidSignalDecisionReport extends AbstractPlaidTool
{
    protected const NAME = 'plaid_signal_decision_report';
    protected const DESCRIPTION = 'Report whether you initiated an ACH transaction

Official Plaid endpoint: POST /signal/decision/report

After you call `/signal/evaluate`, Plaid will normally infer the outcome from your Signal Rules. However, if you are not using Signal Rules, if the Signal Rules outcome was `REVIEW`, or if you take a different action than the one determined by the Signal Rules, you will need to call `/signal/decision/report`. This helps improve Signal Transaction Score accuracy for your account and is necessary for proper functioning of the rule performance and rule tuning capabilities in the Dashboard. If your effective decision changes after calling `/signal/decision/report` (for example, you indicated that you accepted a transaction, but later on, your payment processor rejected it, so it was never ini...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/signal/decision/report';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}