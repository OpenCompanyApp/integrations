<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex source types.
 */
class OpenAlexListSourceTypes extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_source_types';
    protected const ENTITY = 'source-types';
    protected const LABEL = 'source types';
}
