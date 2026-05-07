<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates board classification for not-classified only or all boards in an existing team. Required scope boards:write Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint PATCH /v2/orgs/{org_id}/teams/{team_id}/data-classification.
 */
class MiroEnterpriseDataclassificationTeamBoardsBulk extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_dataclassification_team_boards_bulk';
    protected const DESCRIPTION = 'Updates board classification for not-classified only or all boards in an existing team. Required scope boards:write Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: PATCH /v2/orgs/{org_id}/teams/{team_id}/data-classification.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'id of the organization',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'id of the team',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/data-classification';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
