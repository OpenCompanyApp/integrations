<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex awards.
 */
class OpenAlexListAwards extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_awards';
    protected const ENTITY = 'awards';
    protected const LABEL = 'awards';
}
