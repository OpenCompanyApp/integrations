<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Retrospective Template.
 *
 * Maps to the official Rootly endpoint get /v1/post_mortem_templates/{id}.
 */
class RootlyGetPostmortemTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_postmortem_template';
    protected const DESCRIPTION = 'Retrieves a Retrospective Template

Official Rootly endpoint: GET /v1/post_mortem_templates/{id}

Retrieves a specific Retrospective Template by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortem_templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
