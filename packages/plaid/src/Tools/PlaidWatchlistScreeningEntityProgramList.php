<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List entity watchlist screening programs.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/entity/program/list.
 */
class PlaidWatchlistScreeningEntityProgramList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_entity_program_list';
    protected const DESCRIPTION = 'List entity watchlist screening programs

Official Plaid endpoint: POST /watchlist_screening/entity/program/list

List all entity watchlist screening programs';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/entity/program/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}