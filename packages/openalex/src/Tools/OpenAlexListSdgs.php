<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex SDGs.
 */
class OpenAlexListSdgs extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_sdgs';
    protected const ENTITY = 'sdgs';
    protected const LABEL = 'SDGs';
}
