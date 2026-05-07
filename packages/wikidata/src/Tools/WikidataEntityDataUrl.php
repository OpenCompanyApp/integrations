<?php

namespace OpenCompany\Integrations\Wikidata\Tools;

/**
 * Build a Wikidata entity data URL.
 */
class WikidataEntityDataUrl extends AbstractWikidataTool
{
    protected const NAME = 'wikidata_entity_data_url';
    protected const DESCRIPTION = 'Build a Wikidata Special:EntityData URL for one Q or P entity.';
    protected const METHOD = 'entityDataUrl';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Wikidata Q or P identifier, such as Q42 or P31.'],
        'format' => ['type' => 'string', 'required' => false, 'description' => 'Entity data format.', 'enum' => ['json', 'ttl', 'nt', 'rdf', 'n3']],
    ];
}
