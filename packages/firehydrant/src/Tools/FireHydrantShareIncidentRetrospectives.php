<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Share an incident's retrospective.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/retrospectives/share.
 */
class FireHydrantShareIncidentRetrospectives extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_share_incident_retrospectives';
    protected const DESCRIPTION = 'Share an incident\'s retrospective

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/retrospectives/share

Share incident retrospectives with users or teams';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/share';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
