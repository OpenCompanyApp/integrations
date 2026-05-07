<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List events for an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/events.
 */
class FireHydrantListIncidentEvents extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_events';
    protected const DESCRIPTION = 'List events for an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/events

List all events for an incident. An event is a timeline entry. This can be filtered with params to retrieve events of a certain type.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'types' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of types of events to filter by. Possible values are:
 - `add_task_list`: Task list was added
 - `alert_event`: Someone was paged or took action on a linked alert
 - `alert_linked`: An alert was linked to the incident
 - `bulk_milestone_update`: When a milestone change occurs with no other changes
 - `bulk_update`: When an incident note/update is posted or when impacted components are updated. If other changes occur together with either of these changes (e.g., milestone change), they are all bundled together into a bulk_update
 - `change_type`: Updates to associated change events
 - `chat_message`: Any chat message event in a linked chat app like Slack or MS Teams
 - `children_changed`: When adding or updating child related incidents
 - `external_link`: When an external link is added or updated
 - `general_update`: Currently only describes Runbook stoppage events
 - `generic_chat_message`: When an event or message is manually added to the timeline via the web UI or API
 - `incident_attachment`: When attachments or files are added to the timeline
 - `generic_resource_change`: Any changes to individual fields within the incident, including custom fields
 - `incident_restriction`: When an incident is converted to private
 - `incident_status`: Only used when an incident starts and changes to an `active` state
 - `note`: When a message is posted to a status page directly and not via `/fh update`
 - `role_update`: Any updates to assigned roles
 - `runbook_attachment`: Any updates to a runbook
 - `runbook_step_execution_update`: Any Runbook step events
 - `task_update`: Task update events
 - `team_assignment`: Team assignment events
 - `ticket_update`: Updates to incident and follow-up tickets',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/events';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'types' => 'types',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
