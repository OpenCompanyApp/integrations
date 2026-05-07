<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex country by OpenAlex ID.
 */
class OpenAlexGetCountry extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_country';
    protected const ENTITY = 'countries';
    protected const LABEL = 'country';
}
