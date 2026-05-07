<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Regenerate an On-Call Pay Report.
 *
 * Maps to the official Rootly endpoint post /v1/on_call_pay_reports/{id}/regenerate.
 */
class RootlyRegenerateOnCallPayReport extends AbstractRootlyTool
{
    protected const NAME = 'rootly_regenerate_on_call_pay_report';
    protected const DESCRIPTION = 'Regenerate an On-Call Pay Report

Official Rootly endpoint: POST /v1/on_call_pay_reports/{id}/regenerate

Triggers regeneration of an existing on-call pay report.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/on_call_pay_reports/{id}/regenerate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
