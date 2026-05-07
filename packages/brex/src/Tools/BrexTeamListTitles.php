<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List titles.
 *
 * Maps to the official Brex endpoint get /v2/titles.
 */
class BrexTeamListTitles extends AbstractBrexTool
{
    protected const NAME = 'brex_team_list_titles';
    protected const DESCRIPTION = 'List titles

Official Brex endpoint: GET /v2/titles

This endpoint lists all titles.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/titles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
