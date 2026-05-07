<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a Retrospective Template.
 *
 * Maps to the official Rootly endpoint put /v1/post_mortem_templates/{id}.
 */
class RootlyUpdatePostmortemTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_postmortem_template';
    protected const DESCRIPTION = 'Update a Retrospective Template

Official Rootly endpoint: PUT /v1/post_mortem_templates/{id}

Update a specific Retrospective Template by id';
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
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/post_mortem_templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
