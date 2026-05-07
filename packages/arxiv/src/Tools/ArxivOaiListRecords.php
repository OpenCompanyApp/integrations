<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

/**
 * List arXiv OAI-PMH metadata records.
 */
class ArxivOaiListRecords extends AbstractArxivTool
{
    protected const TOOL_NAME = 'arxiv_oai_list_records';
    protected const TOOL_DESCRIPTION = 'List arXiv OAI-PMH records for a metadata prefix, date range, set, or resumption token.';
    protected const PARAMETERS = [
        'metadataPrefix' => ['type' => 'string', 'required' => false, 'description' => 'Metadata prefix such as arXiv, arXivRaw, or oai_dc. Defaults to arXiv unless resumptionToken is used.'],
        'from' => ['type' => 'string', 'required' => false, 'description' => 'Inclusive start date, for example 2024-01-01.'],
        'until' => ['type' => 'string', 'required' => false, 'description' => 'Inclusive end date, for example 2024-01-31.'],
        'set' => ['type' => 'string', 'required' => false, 'description' => 'Optional OAI set such as cs.'],
        'resumptionToken' => ['type' => 'string', 'required' => false, 'description' => 'Token returned by a previous ListRecords response.'],
    ];

    protected function run(array $args): array
    {
        $params = $this->optional($args, ['metadataPrefix', 'from', 'until', 'set', 'resumptionToken']);
        if (($params['resumptionToken'] ?? '') === '' && ($params['metadataPrefix'] ?? '') === '') {
            $params['metadataPrefix'] = 'arXiv';
        }

        return $this->service->oaiListRecords($params);
    }
}
