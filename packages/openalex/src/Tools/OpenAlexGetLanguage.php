<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex language by OpenAlex ID.
 */
class OpenAlexGetLanguage extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_language';
    protected const ENTITY = 'languages';
    protected const LABEL = 'language';
}
