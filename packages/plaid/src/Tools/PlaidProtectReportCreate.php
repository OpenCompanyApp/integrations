<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a Protect report.
 *
 * Maps to the official Plaid endpoint post /protect/report/create.
 */
class PlaidProtectReportCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_protect_report_create';
    protected const DESCRIPTION = 'Create a Protect report

Official Plaid endpoint: POST /protect/report/create

Use this endpoint to create a Protect report to document fraud incidents, investigation outcomes, or other risk events. This endpoint allows you to report various types of incidents including account takeovers, identity fraud, unauthorized transactions, and other security events. The reported data helps improve fraud detection models and provides valuable feedback to enhance the overall security of the Plaid network. Reports can be created for confirmed incidents that have been fully investigated, or for suspected incidents that require further review. You can associate reports with specific users, sessions, or transactions to provide comprehensive context about the incident.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/protect/report/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}