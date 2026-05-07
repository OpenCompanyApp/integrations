<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Sub-Status.
 *
 * Maps to the official Rootly endpoint delete /v1/sub_statuses/{id}.
 */
class RootlyDeleteSubStatus extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_sub_status';
    protected const DESCRIPTION = 'Delete a Sub-Status

Official Rootly endpoint: DELETE /v1/sub_statuses/{id}

Delete a specific Sub-Status by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/sub_statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
