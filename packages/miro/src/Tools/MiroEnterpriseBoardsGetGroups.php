<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves information about user groups invited to the specified board. Required scope organizations:groups:read boards:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/boards/{board_id}/groups.
 */
class MiroEnterpriseBoardsGetGroups extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_boards_get_groups';
    protected const DESCRIPTION = 'Retrieves information about user groups invited to the specified board. Required scope organizations:groups:read boards:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/boards/{board_id}/groups.';
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
      'limit' => array (
        'type' => 'integer',
        'description' => 'The maximum number of user groups in the result list.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'A representation of the position of a user group in the full set of results. It is used to determine the first item of the resulting set. Leave empty to retrieve items from the beginning.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/boards/{board_id}/groups';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'cursor' => 'cursor',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
