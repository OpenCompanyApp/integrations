<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Shows a communications template.
 *
 * Maps to the official Rootly endpoint get /v1/communications/templates/{id}.
 */
class RootlyGetCommunicationsTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_communications_template';
    protected const DESCRIPTION = 'Shows a communications template

Official Rootly endpoint: GET /v1/communications/templates/{id}

Shows details of a communications template';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Template ID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/communications/templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
