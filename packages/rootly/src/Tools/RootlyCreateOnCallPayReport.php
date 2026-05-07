<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an On-Call Pay Report.
 *
 * Maps to the official Rootly endpoint post /v1/on_call_pay_reports.
 */
class RootlyCreateOnCallPayReport extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_on_call_pay_report';
    protected const DESCRIPTION = 'Creates an On-Call Pay Report

Official Rootly endpoint: POST /v1/on_call_pay_reports

Generates a new on-call pay report for the given date range. The report is generated asynchronously.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/on_call_pay_reports';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
