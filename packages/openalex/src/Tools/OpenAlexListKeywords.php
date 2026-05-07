<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex keywords.
 */
class OpenAlexListKeywords extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_keywords';
    protected const ENTITY = 'keywords';
    protected const LABEL = 'keywords';
}
