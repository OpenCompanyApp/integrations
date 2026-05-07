<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex funder by OpenAlex ID.
 */
class OpenAlexGetFunder extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_funder';
    protected const ENTITY = 'funders';
    protected const LABEL = 'funder';
}
