<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List individual watchlist screening programs.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/individual/program/list.
 */
class PlaidWatchlistScreeningIndividualProgramList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_individual_program_list';
    protected const DESCRIPTION = 'List individual watchlist screening programs

Official Plaid endpoint: POST /watchlist_screening/individual/program/list

List all individual watchlist screening programs';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/individual/program/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}