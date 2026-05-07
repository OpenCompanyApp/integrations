<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Report a return for an ACH transaction.
 *
 * Maps to the official Plaid endpoint post /signal/return/report.
 */
class PlaidSignalReturnReport extends AbstractPlaidTool
{
    protected const NAME = 'plaid_signal_return_report';
    protected const DESCRIPTION = 'Report a return for an ACH transaction

Official Plaid endpoint: POST /signal/return/report

Call the `/signal/return/report` endpoint to report a returned transaction that was previously sent to the `/signal/evaluate` endpoint. Your feedback will be used by the model to incorporate the latest risk trends into your scores and tune rule logic. If using a Balance-only ruleset, this endpoint will not impact scores (as Balance does not use scores), but is necessary to view accurate transaction outcomes and tune rule logic in the Dashboard.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/signal/return/report';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}