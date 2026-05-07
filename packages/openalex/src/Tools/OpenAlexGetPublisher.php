<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex publisher by OpenAlex ID, Wikidata ID, or supported external ID.
 */
class OpenAlexGetPublisher extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_publisher';
    protected const ENTITY = 'publishers';
    protected const LABEL = 'publisher';
}
