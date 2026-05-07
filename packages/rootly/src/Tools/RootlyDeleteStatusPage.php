<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a status page.
 *
 * Maps to the official Rootly endpoint delete /v1/status-pages/{id}.
 */
class RootlyDeleteStatusPage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_status_page';
    protected const DESCRIPTION = 'Delete a status page

Official Rootly endpoint: DELETE /v1/status-pages/{id}

Delete a specific status page by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/status-pages/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
