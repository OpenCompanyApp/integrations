<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** List DataCite providers. */
class DataCiteListProviders extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_list_providers';
    protected const DESCRIPTION = 'List DataCite providers, including members and consortium organizations.';
    protected const PATH = 'providers';
}
