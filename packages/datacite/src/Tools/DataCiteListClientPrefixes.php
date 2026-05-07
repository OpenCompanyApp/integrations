<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** List DataCite client-prefix links. */
class DataCiteListClientPrefixes extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_list_client_prefixes';
    protected const DESCRIPTION = 'List DataCite client-prefix records.';
    protected const PATH = 'client-prefixes';
}
