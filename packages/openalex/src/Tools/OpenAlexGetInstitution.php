<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex institution by OpenAlex ID, ROR, or supported external ID.
 */
class OpenAlexGetInstitution extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_institution';
    protected const ENTITY = 'institutions';
    protected const LABEL = 'institution';
}
