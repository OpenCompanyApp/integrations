<?php

namespace OpenCompany\Integrations\Wikidata\Tools;

/**
 * Build a Wikidata entity page URL.
 */
class WikidataEntityPageUrl extends AbstractWikidataTool
{
    protected const NAME = 'wikidata_entity_page_url';
    protected const DESCRIPTION = 'Build the canonical Wikidata web page URL for one Q or P entity.';
    protected const METHOD = 'entityPageUrl';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Wikidata Q or P identifier, such as Q42 or P31.'],
    ];
}
