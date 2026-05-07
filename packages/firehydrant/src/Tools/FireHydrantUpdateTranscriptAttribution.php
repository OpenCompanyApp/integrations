<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update the attribution of a transcript.
 *
 * Maps to the official FireHydrant endpoint put /v1/incidents/{incident_id}/transcript/attribution.
 */
class FireHydrantUpdateTranscriptAttribution extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_transcript_attribution';
    protected const DESCRIPTION = 'Update the attribution of a transcript

Official FireHydrant endpoint: PUT /v1/incidents/{incident_id}/transcript/attribution

Update the attribution of a transcript';
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
    protected const PATH = '/v1/incidents/{incident_id}/transcript/attribution';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
