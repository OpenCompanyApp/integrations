<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update interaction event.
 *
 * Maps to PUT /api/experience/interaction-event in the official Logto OpenAPI source.
 */
class LogtoUpdateInteractionEvent extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_interaction_event',
  'class' => 'LogtoUpdateInteractionEvent',
  'method' => 'PUT',
  'path' => '/api/experience/interaction-event',
  'operation_id' => 'UpdateInteractionEvent',
  'summary' => 'Update interaction event',
  'description' => 'Update the current experience interaction event to the given event type. This API is used to switch the interaction event between `SignIn` and `Register`, while keeping all the verification records data.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
