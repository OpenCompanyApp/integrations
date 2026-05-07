<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Removes a user group from the specified board. Required scope organizations:groups:read boards:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint DELETE /v2/orgs/{org_id}/boards/{board_id}/groups/{group_id}.
 */
class MiroEnterpriseBoardsDeleteGroups extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_boards_delete_groups';
    protected const DESCRIPTION = 'Removes a user group from the specified board. Required scope organizations:groups:read boards:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: DELETE /v2/orgs/{org_id}/boards/{board_id}/groups/{group_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of an organization.',
        'required' => true,
      ),
      'board_id' => array (
        'type' => 'string',
        'description' => 'The ID of the board.',
        'required' => true,
      ),
      'group_id' => array (
        'type' => 'string',
        'description' => 'The ID of a user group.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/orgs/{org_id}/boards/{board_id}/groups/{group_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'board_id' => 'board_id',
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
