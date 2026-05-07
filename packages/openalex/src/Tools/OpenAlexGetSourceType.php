<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex source type by OpenAlex ID.
 */
class OpenAlexGetSourceType extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_source_type';
    protected const ENTITY = 'source-types';
    protected const LABEL = 'source type';
}
