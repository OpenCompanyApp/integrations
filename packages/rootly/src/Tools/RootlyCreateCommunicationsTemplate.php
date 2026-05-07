<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a communications template.
 *
 * Maps to the official Rootly endpoint post /v1/communications/templates.
 */
class RootlyCreateCommunicationsTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_communications_template';
    protected const DESCRIPTION = 'Creates a communications template

Official Rootly endpoint: POST /v1/communications/templates

Creates a new communications template from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/communications/templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
