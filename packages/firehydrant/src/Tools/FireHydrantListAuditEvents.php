<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List audit events.
 *
 * Maps to the official FireHydrant endpoint get /v1/audit_events.
 */
class FireHydrantListAuditEvents extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_audit_events';
    protected const DESCRIPTION = 'List audit events

Official FireHydrant endpoint: GET /v1/audit_events

List audit events';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'description' => 'Cursor for pagination.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'description' => 'Query string to filter audit events, concatenated with AND keyword.
Available filters with example:
  - event.occurred_at < 2023-01-01T00:00:00Z
  - event.key = signals.on_call_rotation.generate
  - event.actor.kind = user
  - event.actor.id = 00000000-0000-0000-0000-000000000000
  - resource.kind = incident
  - resource.id = 00000000-0000-0000-0000-000000000000
  - parent_id = 00000000-0000-0000-0000-000000000000
Valid query looks like (without quotes):
  event.occurred_at < 2023-01-01T00:00:00Z AND event.key = signals.on_call_rotation.generate',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Number of records to display in a single page, maximum is 100 entries. Smaller number is recommended for better performance.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/audit_events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'filter' => 'filter',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
