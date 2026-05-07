<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Export an incident's retrospective(s) as markdown.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/retrospectives/export_markdown.
 */
class FireHydrantExportIncidentRetrospectivesMarkdown extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_export_incident_retrospectives_markdown';
    protected const DESCRIPTION = 'Export an incident\'s retrospective(s) as markdown

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/retrospectives/export_markdown

Export incident\'s retrospective(s) as markdown';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/export_markdown';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
