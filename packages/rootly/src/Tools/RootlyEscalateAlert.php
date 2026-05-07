<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Escalates an alert.
 *
 * Maps to the official Rootly endpoint post /v1/alerts/{id}/escalate.
 */
class RootlyEscalateAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_escalate_alert';
    protected const DESCRIPTION = 'Escalates an alert

Official Rootly endpoint: POST /v1/alerts/{id}/escalate

Escalates a specific alert to the next or specified level in its escalation policy';
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
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alerts/{id}/escalate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
