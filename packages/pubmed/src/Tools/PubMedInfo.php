<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Inspect Entrez databases, fields, and links with EInfo.
 */
class PubMedInfo extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_info';
    protected const DESCRIPTION = 'Inspect Entrez database metadata, fields, link names, and available databases with EInfo.';
    protected const UTILITY = 'einfo';
    protected const DEFAULTS = ['retmode' => 'json'];
    protected const PARAMETERS = [
        'db' => ['type' => 'string', 'required' => false, 'description' => 'Entrez database. Omit to list available Entrez databases.'],
        'version' => ['type' => 'string', 'required' => false, 'description' => 'EInfo version, such as 2.0.'],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Response mode. Defaults to json.'],
    ];
}
