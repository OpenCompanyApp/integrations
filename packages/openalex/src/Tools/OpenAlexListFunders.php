<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex funders.
 */
class OpenAlexListFunders extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_funders';
    protected const ENTITY = 'funders';
    protected const LABEL = 'funders';
}
