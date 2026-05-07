<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List history for entity watchlist screenings.
 *
 * Maps to the official Plaid endpoint post /watchlist_screening/entity/history/list.
 */
class PlaidWatchlistScreeningEntityHistoryList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_watchlist_screening_entity_history_list';
    protected const DESCRIPTION = 'List history for entity watchlist screenings

Official Plaid endpoint: POST /watchlist_screening/entity/history/list

List all changes to the entity watchlist screening in reverse-chronological order. If the watchlist screening has not been edited, no history will be returned.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/watchlist_screening/entity/history/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}