<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an SLA.
 *
 * Maps to the official Rootly endpoint post /v1/slas.
 */
class RootlyCreateSla extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_sla';
    protected const DESCRIPTION = 'Creates an SLA

Official Rootly endpoint: POST /v1/slas

Creates a new SLA from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/slas';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
