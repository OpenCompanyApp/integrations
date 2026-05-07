<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Retrospective Template.
 *
 * Maps to the official Rootly endpoint delete /v1/post_mortem_templates/{id}.
 */
class RootlyDeletePostmortemTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_postmortem_template';
    protected const DESCRIPTION = 'Delete a Retrospective Template

Official Rootly endpoint: DELETE /v1/post_mortem_templates/{id}

Delete a specific Retrospective Template by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
