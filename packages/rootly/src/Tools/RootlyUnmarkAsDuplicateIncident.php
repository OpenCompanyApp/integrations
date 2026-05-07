<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Remove duplicate marking from an incident.
 *
 * Maps to the official Rootly endpoint put /v1/incidents/{id}/unmark_as_duplicate.
 */
class RootlyUnmarkAsDuplicateIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_unmark_as_duplicate_incident';
    protected const DESCRIPTION = 'Remove duplicate marking from an incident

Official Rootly endpoint: PUT /v1/incidents/{id}/unmark_as_duplicate

Remove the duplicate marking from an incident';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incidents/{id}/unmark_as_duplicate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
