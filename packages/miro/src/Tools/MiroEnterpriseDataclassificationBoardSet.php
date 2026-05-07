<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates board classification for an existing board. Required scope boards:write Rate limiting Level 2 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/teams/{team_id}/boards/{board_id}/data-classification.
 */
class MiroEnterpriseDataclassificationBoardSet extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_dataclassification_board_set';
    protected const DESCRIPTION = 'Updates board classification for an existing board. Required scope boards:write Rate limiting Level 2 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: POST /v2/orgs/{org_id}/teams/{team_id}/boards/{board_id}/data-classification.';
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
      'board_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier of the board that you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/boards/{board_id}/data-classification';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
