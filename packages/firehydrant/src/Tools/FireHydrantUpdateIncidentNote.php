<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a note.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/notes/{note_id}.
 */
class FireHydrantUpdateIncidentNote extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_note';
    protected const DESCRIPTION = 'Update a note

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/notes/{note_id}

Updates the body of a note';
    protected const PARAMETERS = array (
  'note_id' =>
  array (
    'type' => 'string',
    'description' => 'note_id parameter.',
    'required' => true,
  ),
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
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incidents/{incident_id}/notes/{note_id}';
    protected const PATH_PARAMS = array (
  'note_id' => 'note_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
