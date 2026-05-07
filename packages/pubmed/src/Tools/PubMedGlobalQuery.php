<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Search all Entrez databases and return counts with EGQuery.
 */
class PubMedGlobalQuery extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_global_query';
    protected const DESCRIPTION = 'Search all Entrez databases with EGQuery and return the matching record count for each database.';
    protected const UTILITY = 'egquery';
    protected const REQUIRED = ['term'];
    protected const PARAMETERS = [
        'term' => ['type' => 'string', 'required' => true, 'description' => 'Query text to search across Entrez databases.'],
    ];
}
