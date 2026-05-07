<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * Identify the arXiv OAI-PMH repository.
 */
class ArxivOaiIdentify extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_oai_identify';
    protected const TOOL_DESCRIPTION = 'Read repository metadata from the arXiv OAI-PMH Identify verb.';
    protected const PARAMETERS = [];

    protected function run(array $args): array
    {
        return $this->service->oaiIdentify();
    }
}
