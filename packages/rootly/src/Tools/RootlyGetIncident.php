<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident.
 *
 * Maps to the official Rootly endpoint get /v1/incidents/{id}.
 */
class RootlyGetIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident';
    protected const DESCRIPTION = 'Retrieves an incident

Official Rootly endpoint: GET /v1/incidents/{id}

Retrieves a specific incident by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: sub_statuses,causes,subscribers',
    'enum' =>
    array (
      0 => 'sub_statuses',
      1 => 'causes',
      2 => 'subscribers',
      3 => 'roles',
      4 => 'slack_messages',
      5 => 'environments',
      6 => 'incident_types',
      7 => 'services',
      8 => 'functionalities',
      9 => 'groups',
      10 => 'events',
      11 => 'action_items',
      12 => 'custom_field_selections',
      13 => 'feedbacks',
      14 => 'incident_post_mortem',
      15 => 'alerts',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
