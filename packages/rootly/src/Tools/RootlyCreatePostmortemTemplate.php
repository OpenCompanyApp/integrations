<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a retrospective template.
 *
 * Maps to the official Rootly endpoint post /v1/post_mortem_templates.
 */
class RootlyCreatePostmortemTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_postmortem_template';
    protected const DESCRIPTION = 'Creates a retrospective template

Official Rootly endpoint: POST /v1/post_mortem_templates

Creates a new Retrospective Template from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/post_mortem_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
