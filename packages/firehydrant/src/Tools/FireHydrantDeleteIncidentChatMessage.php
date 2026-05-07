<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a chat message from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/generic_chat_messages/{message_id}.
 */
class FireHydrantDeleteIncidentChatMessage extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_chat_message';
    protected const DESCRIPTION = 'Delete a chat message from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/generic_chat_messages/{message_id}

Delete an existing generic chat message on an incident.';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/generic_chat_messages/{message_id}';
    protected const PATH_PARAMS = array (
  'message_id' => 'message_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
