<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** List DataCite clients. */
class DataCiteListClients extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_list_clients';
    protected const DESCRIPTION = 'List DataCite clients, also known as repositories.';
    protected const PATH = 'clients';
}
