<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Acknowledges an alert.
 *
 * Maps to the official Rootly endpoint post /v1/alerts/{id}/acknowledge.
 */
class RootlyAcknowledgeAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_acknowledge_alert';
    protected const DESCRIPTION = 'Acknowledges an alert

Official Rootly endpoint: POST /v1/alerts/{id}/acknowledge

Acknowledges a specific alert by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alerts/{id}/acknowledge';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
