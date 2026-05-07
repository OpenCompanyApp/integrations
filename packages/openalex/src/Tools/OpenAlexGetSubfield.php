<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex subfield by OpenAlex ID.
 */
class OpenAlexGetSubfield extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_subfield';
    protected const ENTITY = 'subfields';
    protected const LABEL = 'subfield';
}
