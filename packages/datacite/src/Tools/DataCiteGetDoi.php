<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get a DataCite DOI metadata record. */
class DataCiteGetDoi extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_doi';
    protected const DESCRIPTION = 'Get a DataCite DOI metadata record.';
    protected const PATH = 'dois/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'DOI, such as 10.5438/0012.'],
    ];
}
