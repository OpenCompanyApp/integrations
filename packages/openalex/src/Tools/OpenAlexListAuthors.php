<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex authors.
 */
class OpenAlexListAuthors extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_authors';
    protected const ENTITY = 'authors';
    protected const LABEL = 'authors';
}
