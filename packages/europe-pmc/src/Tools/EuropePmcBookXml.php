<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve bookshelf XML by Europe PMC article ID.
 */
class EuropePmcBookXml extends EuropePmcFullTextXml
{
    protected const NAME = 'europe_pmc_book_xml';
    protected const DESCRIPTION = 'Retrieve book XML formatted full text for Europe PMC bookshelf content.';
    protected const PATH = '{id}/bookXML';
}
