<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a incident event.
 *
 * Maps to the official Rootly endpoint delete /v1/templates/{id}.
 */
class RootlyDeleteStatusPageTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_status_page_template';
    protected const DESCRIPTION = 'Delete a incident event

Official Rootly endpoint: DELETE /v1/templates/{id}

Delete a specific template event by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
