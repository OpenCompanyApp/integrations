<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex work types.
 */
class OpenAlexListWorkTypes extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_work_types';
    protected const ENTITY = 'work-types';
    protected const LABEL = 'work types';
}
