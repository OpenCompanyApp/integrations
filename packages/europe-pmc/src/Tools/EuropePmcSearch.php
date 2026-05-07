<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Search Europe PMC publication metadata with GET /search.
 */
class EuropePmcSearch extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_search';
    protected const DESCRIPTION = 'Search Europe PMC publications with query syntax, result type, sorting, cursor paging, and JSON/XML/DC formats.';
    protected const PATH = 'search';
    protected const DEFAULTS = ['format' => 'json', 'resultType' => 'lite'];
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Europe PMC query syntax.'],
        'resultType' => ['type' => 'string', 'required' => false, 'description' => 'idlist, lite, or core. Defaults to lite.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Results per page, up to the API limit.'],
        'cursorMark' => ['type' => 'string', 'required' => false, 'description' => 'Cursor mark for deep paging. Use * for first page.'],
        'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort expression such as CITED desc.'],
        'synonym' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to expand query synonyms.'],
    ];
}
