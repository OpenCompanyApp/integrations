<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List authorizations.
 *
 * Maps to the official Rootly endpoint get /v1/authorizations.
 */
class RootlyListAuthorizations extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_authorizations';
    protected const DESCRIPTION = 'List authorizations

Official Rootly endpoint: GET /v1/authorizations

List authorizations';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'filter_authorizable_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[authorizable_id] parameter.',
  ),
  'filter_authorizable_type' =>
  array (
    'type' => 'string',
    'description' => 'filter[authorizable_type] parameter.',
  ),
  'filter_grantee_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[grantee_id] parameter.',
  ),
  'filter_grantee_type' =>
  array (
    'type' => 'string',
    'description' => 'filter[grantee_type] parameter.',
  ),
  'filter_created_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gt] parameter.',
  ),
  'filter_created_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gte] parameter.',
  ),
  'filter_created_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lt] parameter.',
  ),
  'filter_created_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lte] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/authorizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[authorizable_id]' => 'filter_authorizable_id',
  'filter[authorizable_type]' => 'filter_authorizable_type',
  'filter[grantee_id]' => 'filter_grantee_id',
  'filter[grantee_type]' => 'filter_grantee_type',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
