<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex publishers.
 */
class OpenAlexListPublishers extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_publishers';
    protected const ENTITY = 'publishers';
    protected const LABEL = 'publishers';
}
