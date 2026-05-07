<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex continent by OpenAlex ID.
 */
class OpenAlexGetContinent extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_continent';
    protected const ENTITY = 'continents';
    protected const LABEL = 'continent';
}
