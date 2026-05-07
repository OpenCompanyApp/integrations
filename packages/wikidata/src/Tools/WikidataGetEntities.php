<?php

namespace OpenCompany\Integrations\Wikidata\Tools;

/**
 * Retrieve Wikidata entities.
 */
class WikidataGetEntities extends AbstractWikidataTool
{
    protected const NAME = 'wikidata_get_entities';
    protected const DESCRIPTION = 'Retrieve Wikidata entities by pipe-separated IDs or by sites and titles.';
    protected const METHOD = 'getEntities';
    protected const PARAMETERS = [
        'ids' => ['type' => 'string', 'required' => false, 'description' => 'Pipe-separated entity IDs, such as Q42|Q60.'],
        'sites' => ['type' => 'string', 'required' => false, 'description' => 'Pipe-separated site IDs, such as enwiki. Required with titles when ids is omitted.'],
        'titles' => ['type' => 'string', 'required' => false, 'description' => 'Pipe-separated site titles. Required with sites when ids is omitted.'],
        'props' => ['type' => 'string', 'required' => false, 'description' => 'Pipe-separated props. Default: labels|descriptions|aliases|claims|sitelinks.'],
        'languages' => ['type' => 'string', 'required' => false, 'description' => 'Pipe-separated language codes.'],
        'sitefilter' => ['type' => 'string', 'required' => false, 'description' => 'Pipe-separated site IDs to include in sitelinks.'],
    ];
}
