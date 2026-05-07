<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Search PubMed or another Entrez database with ESearch.
 */
class PubMedSearch extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_search';
    protected const DESCRIPTION = 'Search PubMed or another NCBI Entrez database with ESearch. Supports paging, date filters, sorting, field scoping, and History server output.';
    protected const UTILITY = 'esearch';
    protected const DEFAULTS = ['db' => 'pubmed', 'retmode' => 'json'];
    protected const REQUIRED = ['term'];
    protected const PARAMETERS = [
        'term' => ['type' => 'string', 'required' => true, 'description' => 'Search term or full Entrez query syntax.'],
        'retmax' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of UIDs to return.'],
        'retstart' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort order supported by the target database.'],
        'field' => ['type' => 'string', 'required' => false, 'description' => 'Optional search field.'],
        'datetype' => ['type' => 'string', 'required' => false, 'description' => 'Date field for filtering, such as pdat, edat, or mdat.'],
        'reldate' => ['type' => 'integer', 'required' => false, 'description' => 'Limit to records from the last N days.'],
        'mindate' => ['type' => 'string', 'required' => false, 'description' => 'Minimum date for date filtering.'],
        'maxdate' => ['type' => 'string', 'required' => false, 'description' => 'Maximum date for date filtering.'],
        'usehistory' => ['type' => 'string', 'required' => false, 'description' => 'Set to y to save results to the History server.'],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Response mode. Defaults to json.'],
    ];
}
