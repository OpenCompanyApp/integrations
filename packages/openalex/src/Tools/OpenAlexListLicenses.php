<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * List, search, filter, sort, page, sample, or group OpenAlex licenses.
 */
class OpenAlexListLicenses extends AbstractOpenAlexListTool
{
    protected const NAME = 'openalex_list_licenses';
    protected const ENTITY = 'licenses';
    protected const LABEL = 'licenses';
}
