<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update incident_sub_status.
 *
 * Maps to the official Rootly endpoint put /v1/incident_sub_statuses/{id}.
 */
class RootlyUpdateIncidentSubStatus extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_sub_status';
    protected const DESCRIPTION = 'Update incident_sub_status

Official Rootly endpoint: PUT /v1/incident_sub_statuses/{id}

Update a specific incident_sub_status by id';
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
    protected const PATH = '/v1/incident_sub_statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
