<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex license by OpenAlex ID.
 */
class OpenAlexGetLicense extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_license';
    protected const ENTITY = 'licenses';
    protected const LABEL = 'license';
}
