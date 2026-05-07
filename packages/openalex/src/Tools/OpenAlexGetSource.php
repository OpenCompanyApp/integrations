<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex source by OpenAlex ID, ISSN, or supported external ID.
 */
class OpenAlexGetSource extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_source';
    protected const ENTITY = 'sources';
    protected const LABEL = 'source';
}
