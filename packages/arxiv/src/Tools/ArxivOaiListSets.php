<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * List arXiv OAI-PMH sets.
 */
class ArxivOaiListSets extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_oai_list_sets';
    protected const TOOL_DESCRIPTION = 'List OAI-PMH sets exposed by arXiv, including category sets.';
    protected const PARAMETERS = [
        'resumptionToken' => ['type' => 'string', 'required' => false, 'description' => 'Token returned by a previous ListSets response.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->oaiListSets(
            ($args['resumptionToken'] ?? null) !== null && $args['resumptionToken'] !== '' ? (string) $args['resumptionToken'] : null,
        );
    }
}
