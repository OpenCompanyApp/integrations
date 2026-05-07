<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get individual watchlist screening program.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/individual/program/get.
 */
class PlaidWatchlistScreeningIndividualProgramGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_individual_program_get';
    protected const DESCRIPTION = 'Get individual watchlist screening program

Official Plaid endpoint: POST /watchlist_screening/individual/program/get

Get an individual watchlist screening program';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/individual/program/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}