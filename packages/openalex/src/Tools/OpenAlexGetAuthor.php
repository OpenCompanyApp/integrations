<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex author by OpenAlex ID, ORCID, or supported external ID.
 */
class OpenAlexGetAuthor extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_author';
    protected const ENTITY = 'authors';
    protected const LABEL = 'author';
}
