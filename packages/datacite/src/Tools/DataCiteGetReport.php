<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get a DataCite usage report. */
class DataCiteGetReport extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_report';
    protected const DESCRIPTION = 'Get a DataCite usage report.';
    protected const PATH = 'reports/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Report ID.'],
    ];
}
