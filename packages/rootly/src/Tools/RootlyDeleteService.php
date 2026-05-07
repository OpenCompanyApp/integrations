<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a service.
 *
 * Maps to the official Rootly endpoint delete /v1/services/{id}.
 */
class RootlyDeleteService extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_service';
    protected const DESCRIPTION = 'Delete a service

Official Rootly endpoint: DELETE /v1/services/{id}

Delete a specific service by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/services/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
