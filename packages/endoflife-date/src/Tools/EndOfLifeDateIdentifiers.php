<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * List identifiers for a type and their related products.
 */
class EndOfLifeDateIdentifiers extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_identifiers';
    protected const DESCRIPTION = 'List endoflife.date identifiers for a given identifier type and the related product references.';
    protected const METHOD = 'identifiers';
    protected const REQUIRED = ['identifier_type'];
    protected const PARAMETERS = [
        'identifier_type' => ['type' => 'string', 'required' => true, 'description' => 'Identifier type, such as purl, cpe, or repology.'],
    ];
}
