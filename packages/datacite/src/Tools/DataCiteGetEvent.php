<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get a DataCite Event Data record. */
class DataCiteGetEvent extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_event';
    protected const DESCRIPTION = 'Get a specific DataCite Event Data record.';
    protected const PATH = 'events/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Event ID.'],
    ];
}
