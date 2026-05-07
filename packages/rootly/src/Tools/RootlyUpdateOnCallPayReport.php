<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an On-Call Pay Report.
 *
 * Maps to the official Rootly endpoint put /v1/on_call_pay_reports/{id}.
 */
class RootlyUpdateOnCallPayReport extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_on_call_pay_report';
    protected const DESCRIPTION = 'Update an On-Call Pay Report

Official Rootly endpoint: PUT /v1/on_call_pay_reports/{id}

Update a specific on-call pay report by id. Triggers report regeneration.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/on_call_pay_reports/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
