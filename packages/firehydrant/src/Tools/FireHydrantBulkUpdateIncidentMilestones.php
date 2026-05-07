<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update milestone times.
 *
 * Maps to the official FireHydrant endpoint put /v1/incidents/{incident_id}/milestones/bulk_update.
 */
class FireHydrantBulkUpdateIncidentMilestones extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_bulk_update_incident_milestones';
    protected const DESCRIPTION = 'Update milestone times

Official FireHydrant endpoint: PUT /v1/incidents/{incident_id}/milestones/bulk_update

Update milestone times in bulk for a given incident. All milestone
times for an incident must occur in chronological order
corresponding to the configured order of milestones. If the result
of this request would cause any milestone(s) to appear out of place,
a 422 response will instead be returned. This includes milestones
not explicitly submitted or updated in this request.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incidents/{incident_id}/milestones/bulk_update';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
