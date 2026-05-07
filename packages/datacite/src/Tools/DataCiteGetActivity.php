<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get a DataCite activity record. */
class DataCiteGetActivity extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_activity';
    protected const DESCRIPTION = 'Get a specific DataCite activity record.';
    protected const PATH = 'activities/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Activity ID.'],
    ];
}
