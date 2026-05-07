<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List incident milestones.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/milestones.
 */
class FireHydrantListIncidentMilestones extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_milestones';
    protected const DESCRIPTION = 'List incident milestones

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/milestones

List times and durations for each milestone on an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/milestones';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
