<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex SDG by OpenAlex ID.
 */
class OpenAlexGetSdg extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_sdg';
    protected const ENTITY = 'sdgs';
    protected const LABEL = 'SDG';
}
