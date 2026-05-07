<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Lists all of the messages in the incident's transcript.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/transcript.
 */
class FireHydrantListTranscriptEntries extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_transcript_entries';
    protected const DESCRIPTION = 'Lists all of the messages in the incident\'s transcript

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/transcript

Retrieve the transcript for a specific incident';
    protected const PARAMETERS = array (
  'after' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the transcript entry to start after.',
  ),
  'before' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the transcript entry to start before.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'The order to sort the transcript entries.',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/transcript';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'after' => 'after',
  'before' => 'before',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
