<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Schedule a planned ACH transaction.
 *
 * Maps to the official Plaid endpoint post /signal/schedule.
 */
class PlaidSignalSchedule extends AbstractPlaidTool
{
    protected const NAME = 'plaid_signal_schedule';
    protected const DESCRIPTION = 'Schedule a planned ACH transaction

Official Plaid endpoint: POST /signal/schedule

Use `/signal/schedule` to schedule a planned ACH transaction.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/signal/schedule';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}