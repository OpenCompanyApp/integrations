<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a transcript from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/transcript/{transcript_id}.
 */
class FireHydrantDeleteTranscriptEntry extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_transcript_entry';
    protected const DESCRIPTION = 'Delete a transcript from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/transcript/{transcript_id}

Delete a transcript from an incident';
    protected const PARAMETERS = array (
  'transcript_id' =>
  array (
    'type' => 'string',
    'description' => 'transcript_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/transcript/{transcript_id}';
    protected const PATH_PARAMS = array (
  'transcript_id' => 'transcript_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
