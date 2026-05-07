<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Opt-in a processor token to Signal.
 *
 * Maps to the official Plaid endpoint post /processor/signal/prepare.
 */
class PlaidProcessorSignalPrepare extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_signal_prepare';
    protected const DESCRIPTION = 'Opt-in a processor token to Signal

Official Plaid endpoint: POST /processor/signal/prepare

When a processor token is not initialized with `signal`, call `/processor/signal/prepare` to opt-in that processor token to the data collection process, which will improve the accuracy of the Signal Transaction Score. If this endpoint is called with a processor token that is already initialized with `signal`, it will return a 200 response and will not modify the processor token.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/signal/prepare';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}