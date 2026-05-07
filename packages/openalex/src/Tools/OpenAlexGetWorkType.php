<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex work type by OpenAlex ID.
 */
class OpenAlexGetWorkType extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_work_type';
    protected const ENTITY = 'work-types';
    protected const LABEL = 'work type';
}
