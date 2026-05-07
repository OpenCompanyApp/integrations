<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an SLA.
 *
 * Maps to the official Rootly endpoint delete /v1/slas/{id}.
 */
class RootlyDeleteSla extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_sla';
    protected const DESCRIPTION = 'Delete an SLA

Official Rootly endpoint: DELETE /v1/slas/{id}

Delete a specific SLA by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/slas/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
