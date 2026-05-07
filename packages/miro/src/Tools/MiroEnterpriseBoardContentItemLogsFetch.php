<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves content changes for board items within your organization. Content changes are actions that users can perform on board items, such as updating a sticky note's text. You can retrieve results for a specific time period. You can also filter results based on the board IDs and the emails of users who created, modified, or deleted a board item. Additionally, results can be paginated for easier viewing and processing. Required scope contentlogs:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/content-logs/items.
 */
class MiroEnterpriseBoardContentItemLogsFetch extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_board_content_item_logs_fetch';
    protected const DESCRIPTION = 'Retrieves content changes for board items within your organization. Content changes are actions that users can perform on board items, such as updating a sticky note\'s text. You can retrieve results for a specific time period. You can also filter results based on the board IDs and the emails of users who created, modified, or deleted a board item. Additionally, results can be paginated for easier viewing and processing. Required scope contentlogs:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin.

Official Miro endpoint: GET /v2/orgs/{org_id}/content-logs/items.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier of the organization.',
        'required' => true,
      ),
      'board_ids' => array (
        'type' => 'array',
        'description' => 'List of board IDs for which you want to retrieve the content logs.',
        'required' => false,
      ),
      'emails' => array (
        'type' => 'array',
        'description' => 'Filter content logs based on the list of emails of users who created, modified, or deleted the board item.',
        'required' => false,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Filter content logs based on the date and time when the board item was last modified. This is the start date and time for the modified date duration. Format: UTC, adheres to [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601), includes a [trailing Z offset](https://en.wikipedia.org/wiki/ISO_8601#Coordinated_Universal_Time_(UTC)).',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Filter content logs based on the date and time when the board item was last modified. This is the end date and time for the modified date duration. Format: UTC, adheres to [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601), includes a [trailing Z offset](https://en.wikipedia.org/wiki/ISO_8601#Coordinated_Universal_Time_(UTC)).',
        'required' => true,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'A cursor-paginated method returns a portion of the total set of results based on the limit specified and a cursor that points to the next portion of the results. To retrieve the next portion of the collection, set the cursor parameter equal to the cursor value you received in the response of the previous request.',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The maximum number of results to return per call. If the number of logs in the response is greater than the limit specified, the response returns the cursor parameter with a value.',
        'required' => false,
      ),
      'sorting' => array (
        'type' => 'string',
        'description' => 'Sort order in which you want to view the result set based on the modified date. To sort by an ascending modified date, specify `asc`. To sort by a descending modified date, specify `desc`.',
        'required' => false,
        'enum' => array (
          'asc',
          'desc',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/content-logs/items';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
    );
    protected const QUERY_PARAMS = array (
      'board_ids' => 'board_ids',
      'emails' => 'emails',
      'from' => 'from',
      'to' => 'to',
      'cursor' => 'cursor',
      'limit' => 'limit',
      'sorting' => 'sorting',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
