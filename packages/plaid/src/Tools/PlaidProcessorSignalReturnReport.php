<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Report a return for an ACH transaction.
 *
 * Maps to the official Plaid endpoint post /processor/signal/return/report.
 */
class PlaidProcessorSignalReturnReport extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_signal_return_report';
    protected const DESCRIPTION = 'Report a return for an ACH transaction

Official Plaid endpoint: POST /processor/signal/return/report

Call the `/processor/signal/return/report` endpoint to report a returned transaction that was previously sent to the `/processor/signal/evaluate` endpoint. Your feedback will be used by the model to incorporate the latest risk trend in your portfolio. If you are using the [Plaid Transfer product](https://plaid.com/docs/transfer) to create transfers, it is not necessary to use this endpoint, as Plaid already knows whether the transfer was returned.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/signal/return/report';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}