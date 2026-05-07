<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a playbook.
 *
 * Maps to the official Rootly endpoint post /v1/playbooks.
 */
class RootlyCreatePlaybook extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_playbook';
    protected const DESCRIPTION = 'Creates a playbook

Official Rootly endpoint: POST /v1/playbooks

Creates a new playbook from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/playbooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
