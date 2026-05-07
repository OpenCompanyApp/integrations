<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Search ORCID and return CSV fields.
 */
class OrcidCsvSearch extends OrcidSearch
{
    protected const NAME = 'orcid_csv_search';
    protected const DESCRIPTION = 'Search ORCID and return CSV data for selected output fields.';
    protected const PATH = 'csv-search';
    protected const FORMAT = 'csv';
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Solr search query.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'CSV output columns such as orcid, given-name, family-name, credit-name, and current-institution-affiliation-name.', 'items' => ['type' => 'string']],
        'start' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        'rows' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results to return.'],
    ];
}
