<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Assign user to incident.
 *
 * Maps to the official Rootly endpoint post /v1/incidents/{id}/assign_role_to_user.
 */
class RootlyAssignUserToIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_assign_user_to_incident';
    protected const DESCRIPTION = 'Assign user to incident

Official Rootly endpoint: POST /v1/incidents/{id}/assign_role_to_user

Assign user to incident';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{id}/assign_role_to_user';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
