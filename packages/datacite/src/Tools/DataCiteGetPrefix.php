<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get a DataCite DOI prefix. */
class DataCiteGetPrefix extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_prefix';
    protected const DESCRIPTION = 'Get a DataCite DOI prefix.';
    protected const PATH = 'prefixes/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'DOI prefix, such as 10.5438.'],
    ];
}
