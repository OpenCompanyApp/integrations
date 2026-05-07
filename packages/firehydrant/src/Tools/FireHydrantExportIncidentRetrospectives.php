<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Export an incident's retrospective(s).
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/retrospectives/export.
 */
class FireHydrantExportIncidentRetrospectives extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_export_incident_retrospectives';
    protected const DESCRIPTION = 'Export an incident\'s retrospective(s)

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/retrospectives/export

Export incident\'s retrospective(s) using their templates';
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
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/export';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
