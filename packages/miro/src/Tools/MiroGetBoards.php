<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves a list of boards accessible to the user associated with the provided access token. This endpoint supports filtering and sorting through URL query parameters. Customize the response by specifying `team_id`, `project_id`, or other query parameters. Filtering by `team_id` or `project_id` (or both) returns results instantly. For other filters, allow a few seconds for indexing of newly created boards. If you're an Enterprise customer with Company Admin permissions: - Enable **Content Admin** permissions to retrieve all boards, including private boards (those not explicitly shared with you). For details, see the [Content Admin Permissions for Company Admins](https://help.miro.com/hc/en-us/articles/360012777280-Content-Admin-permissions-for-Company-Admins). - Note that **Private board contents remain inaccessible**. The API allows you to verify their existence but prevents viewing their contents to uphold security best practices. Unauthorized access attempts will return an error. Required scope boards:read Rate limiting Level 1.
 *
 * Maps to the official Miro endpoint GET /v2/boards.
 */
class MiroGetBoards extends AbstractMiroTool
{
    protected const NAME = 'miro_get_boards';
    protected const DESCRIPTION = 'Retrieves a list of boards accessible to the user associated with the provided access token. This endpoint supports filtering and sorting through URL query parameters. Customize the response by specifying `team_id`, `project_id`, or other query parameters. Filtering by `team_id` or `project_id` (or both) returns results instantly. For other filters, allow a few seconds for indexing of newly created boards. If you\'re an Enterprise customer with Company Admin permissions: - Enable **Content Admin** permissions to retrieve all boards, including private boards (those not explicitly shared with you). For details, see the [Content Admin Permissions for Company Admins](https://help.miro.com/hc/en-us/articles/360012777280-Content-Admin-permissions-for-Company-Admins). - Note that **Private board contents remain inaccessible**. The API allows you to verify their existence but prevents viewing their contents to uphold security best practices. Unauthorized access attempts will return an error. Required scope boards:read Rate limiting Level 1

Official Miro endpoint: GET /v2/boards.';
    protected const PARAMETERS = array (
      'team_id' => array (
        'type' => 'string',
        'description' => 'team_id parameter.',
        'required' => false,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'project_id parameter.',
        'required' => false,
      ),
      'query' => array (
        'type' => 'string',
        'description' => 'query parameter.',
        'required' => false,
      ),
      'owner' => array (
        'type' => 'string',
        'description' => 'owner parameter.',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'string',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'offset' => array (
        'type' => 'string',
        'description' => 'offset parameter.',
        'required' => false,
      ),
      'sort' => array (
        'type' => 'string',
        'description' => 'sort parameter.',
        'required' => false,
        'enum' => array (
          'default',
          'last_modified',
          'last_opened',
          'last_created',
          'alphabetically',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/boards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'team_id' => 'team_id',
      'project_id' => 'project_id',
      'query' => 'query',
      'owner' => 'owner',
      'limit' => 'limit',
      'offset' => 'offset',
      'sort' => 'sort',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
