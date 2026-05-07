<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Match formatted citation strings to PubMed IDs with ECitMatch.
 */
class PubMedCitationMatch extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_citation_match';
    protected const DESCRIPTION = 'Match one or more formatted citation strings to PubMed IDs with ECitMatch. Each citation should use journal|year|volume|first_page|author|key| format.';
    protected const UTILITY = 'ecitmatch';
    protected const METHOD = 'POST';
    protected const DEFAULTS = ['db' => 'pubmed'];
    protected const REQUIRED = ['bdata'];
    protected const BODY_FIELDS = ['bdata'];
    protected const PARAMETERS = [
        'citations' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'One formatted citation string or an array of citation strings. Converted to bdata.', 'items' => ['type' => 'string']],
        'bdata' => ['type' => 'string', 'required' => false, 'description' => 'Raw ECitMatch bdata payload. Use when you already have newline-separated citation strings.'],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Optional response mode if supported by the endpoint.'],
    ];

    /**
     * Convert citations into the bdata form field expected by ECitMatch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function prepareArgs(array $args): array
    {
        if (!isset($args['bdata']) && isset($args['citations'])) {
            $citations = $args['citations'];
            $args['bdata'] = is_array($citations)
                ? implode("\r", array_map(static fn (mixed $citation): string => (string) $citation, $citations))
                : (string) $citations;
        }

        unset($args['citations']);

        return $args;
    }
}
