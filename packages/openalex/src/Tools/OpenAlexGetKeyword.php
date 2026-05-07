<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex keyword by OpenAlex ID.
 */
class OpenAlexGetKeyword extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_keyword';
    protected const ENTITY = 'keywords';
    protected const LABEL = 'keyword';
}
