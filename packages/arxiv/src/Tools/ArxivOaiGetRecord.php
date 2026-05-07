<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * Get one arXiv OAI-PMH metadata record.
 */
class ArxivOaiGetRecord extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_oai_get_record';
    protected const TOOL_DESCRIPTION = 'Get one arXiv OAI-PMH metadata record by OAI identifier.';
    protected const PARAMETERS = [
        'identifier' => ['type' => 'string', 'required' => true, 'description' => 'OAI identifier such as oai:arXiv.org:2103.15348.'],
        'metadataPrefix' => ['type' => 'string', 'required' => false, 'description' => 'Metadata prefix such as arXiv, arXivRaw, or oai_dc. Defaults to arXiv.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->oaiGetRecord(
            $this->required($args, 'identifier'),
            ($args['metadataPrefix'] ?? '') !== '' ? (string) $args['metadataPrefix'] : 'arXiv',
        );
    }
}
