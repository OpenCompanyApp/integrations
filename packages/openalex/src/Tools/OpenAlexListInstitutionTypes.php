<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex institution types.
 */
class OpenAlexListInstitutionTypes extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_institution_types';
    protected const ENTITY = 'institution-types';
    protected const LABEL = 'institution types';
}
