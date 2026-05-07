<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Detach an incident from its parent.
 *
 * Maps to the official Rootly endpoint put /v1/incidents/{id}/detach_from_parent.
 */
class RootlyDetachFromParentIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_detach_from_parent_incident';
    protected const DESCRIPTION = 'Detach an incident from its parent

Official Rootly endpoint: PUT /v1/incidents/{id}/detach_from_parent

Detach a sub-incident from its parent incident';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incidents/{id}/detach_from_parent';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
