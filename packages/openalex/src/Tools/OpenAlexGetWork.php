<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex work by OpenAlex ID, DOI, PMID, or supported external ID.
 */
class OpenAlexGetWork extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_work';
    protected const ENTITY = 'works';
    protected const LABEL = 'work';
}
