<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a team.
 *
 * Maps to the official Rootly endpoint delete /v1/teams/{id}.
 */
class RootlyDeleteTeam extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_team';
    protected const DESCRIPTION = 'Delete a team

Official Rootly endpoint: DELETE /v1/teams/{id}

Delete a specific team by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/teams/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
