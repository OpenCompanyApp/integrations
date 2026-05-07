<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Retrieve spelling suggestions for PubMed query text with ESpell.
 */
class PubMedSpell extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_spell';
    protected const DESCRIPTION = 'Retrieve PubMed spelling suggestions for a single text query with ESpell.';
    protected const UTILITY = 'espell';
    protected const DEFAULTS = ['db' => 'pubmed', 'retmode' => 'json'];
    protected const REQUIRED = ['term'];
    protected const PARAMETERS = [
        'term' => ['type' => 'string', 'required' => true, 'description' => 'Query text to spell-check.'],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Response mode. Defaults to json.'],
    ];
}
