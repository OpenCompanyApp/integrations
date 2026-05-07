<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex domain by OpenAlex ID.
 */
class OpenAlexGetDomain extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_domain';
    protected const ENTITY = 'domains';
    protected const LABEL = 'domain';
}
