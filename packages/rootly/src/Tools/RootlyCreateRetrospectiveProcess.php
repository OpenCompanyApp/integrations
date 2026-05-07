<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a retrospective process.
 *
 * Maps to the official Rootly endpoint post /v1/retrospective_processes.
 */
class RootlyCreateRetrospectiveProcess extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_retrospective_process';
    protected const DESCRIPTION = 'Creates a retrospective process

Official Rootly endpoint: POST /v1/retrospective_processes

Creates a new retrospective process from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/retrospective_processes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
