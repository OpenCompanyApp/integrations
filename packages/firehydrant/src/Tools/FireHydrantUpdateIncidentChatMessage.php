<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a chat message on an incident.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/generic_chat_messages/{message_id}.
 */
class FireHydrantUpdateIncidentChatMessage extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_chat_message';
    protected const DESCRIPTION = 'Update a chat message on an incident

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/generic_chat_messages/{message_id}

Update an existing generic chat message on an incident.';
    protected const PARAMETERS = array (
  'message_id' =>
  array (
    'type' => 'string',
    'description' => 'message_id parameter.',
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
    protected const PATH = '/v1/incidents/{incident_id}/generic_chat_messages/{message_id}';
    protected const PATH_PARAMS = array (
  'message_id' => 'message_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
