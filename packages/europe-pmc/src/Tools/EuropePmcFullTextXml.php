<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve Open Access full-text XML by Europe PMC article ID.
 */
class EuropePmcFullTextXml extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_full_text_xml';
    protected const DESCRIPTION = 'Retrieve full text XML for Open Access Europe PMC articles where available.';
    protected const PATH = '{id}/fullTextXML';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Article identifier, commonly a PMCID without source prefix.'],
    ];
}
