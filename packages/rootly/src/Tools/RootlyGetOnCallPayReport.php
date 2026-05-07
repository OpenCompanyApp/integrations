<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an On-Call Pay Report.
 *
 * Maps to the official Rootly endpoint get /v1/on_call_pay_reports/{id}.
 */
class RootlyGetOnCallPayReport extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_on_call_pay_report';
    protected const DESCRIPTION = 'Retrieves an On-Call Pay Report

Official Rootly endpoint: GET /v1/on_call_pay_reports/{id}

Retrieves a specific on-call pay report by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/on_call_pay_reports/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
