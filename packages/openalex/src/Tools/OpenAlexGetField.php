<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex field by OpenAlex ID.
 */
class OpenAlexGetField extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_field';
    protected const ENTITY = 'fields';
    protected const LABEL = 'field';
}
