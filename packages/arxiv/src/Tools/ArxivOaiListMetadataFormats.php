<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * List arXiv OAI-PMH metadata formats.
 */
class ArxivOaiListMetadataFormats extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_oai_list_metadata_formats';
    protected const TOOL_DESCRIPTION = 'List OAI-PMH metadata formats supported by arXiv.';
    protected const PARAMETERS = [
        'identifier' => ['type' => 'string', 'required' => false, 'description' => 'Optional OAI identifier such as oai:arXiv.org:2103.15348.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->oaiListMetadataFormats(
            ($args['identifier'] ?? null) !== null && $args['identifier'] !== '' ? (string) $args['identifier'] : null,
        );
    }
}
