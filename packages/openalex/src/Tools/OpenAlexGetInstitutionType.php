<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex institution type by OpenAlex ID.
 */
class OpenAlexGetInstitutionType extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_institution_type';
    protected const ENTITY = 'institution-types';
    protected const LABEL = 'institution type';
}
