<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get a DataCite client. */
class DataCiteGetClient extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_client';
    protected const DESCRIPTION = 'Get a DataCite client, also known as a repository.';
    protected const PATH = 'clients/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Client/repository ID, such as datacite.datacite.'],
    ];
}
