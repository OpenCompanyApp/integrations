<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Remove assigned user from incident.
 *
 * Maps to the official Rootly endpoint delete /v1/incidents/{id}/unassign_role_from_user.
 */
class RootlyRemoveAssignedUserFromIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_remove_assigned_user_from_incident';
    protected const DESCRIPTION = 'Remove assigned user from incident

Official Rootly endpoint: DELETE /v1/incidents/{id}/unassign_role_from_user

Remove assigned user from incident';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{id}/unassign_role_from_user';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
