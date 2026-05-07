<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * List all known identifier types.
 */
class EndOfLifeDateIdentifierTypes extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_identifier_types';
    protected const DESCRIPTION = 'List identifier types known to endoflife.date, such as purl, cpe, and repology.';
    protected const METHOD = 'identifierTypes';
}
