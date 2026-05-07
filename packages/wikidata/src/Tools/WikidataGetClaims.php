<?php

namespace OpenCompany\Integrations\Wikidata\Tools;

/**
 * Retrieve Wikidata claims.
 */
class WikidataGetClaims extends AbstractWikidataTool
{
    protected const NAME = 'wikidata_get_claims';
    protected const DESCRIPTION = 'Retrieve Wikidata claims by entity, property, rank, or claim ID.';
    protected const METHOD = 'getClaims';
    protected const PARAMETERS = [
        'entity' => ['type' => 'string', 'required' => false, 'description' => 'Entity ID, such as Q42. Required unless claim is provided.'],
        'property' => ['type' => 'string', 'required' => false, 'description' => 'Property ID, such as P31.'],
        'rank' => ['type' => 'string', 'required' => false, 'description' => 'Claim rank filter.', 'enum' => ['preferred', 'normal', 'deprecated']],
        'claim' => ['type' => 'string', 'required' => false, 'description' => 'Specific claim GUID.'],
    ];
}
