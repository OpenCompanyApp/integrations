<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex award by OpenAlex ID.
 */
class OpenAlexGetAward extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_award';
    protected const ENTITY = 'awards';
    protected const LABEL = 'award';
}
