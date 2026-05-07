<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex institutions.
 */
class OpenAlexListInstitutions extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_institutions';
    protected const ENTITY = 'institutions';
    protected const LABEL = 'institutions';
}
