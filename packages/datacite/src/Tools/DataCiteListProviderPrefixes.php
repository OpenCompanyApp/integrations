<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** List DataCite provider-prefix links. */
class DataCiteListProviderPrefixes extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_list_provider_prefixes';
    protected const DESCRIPTION = 'List DataCite provider-prefix records.';
    protected const PATH = 'provider-prefixes';
}
