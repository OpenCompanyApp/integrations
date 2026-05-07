<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get activities for a DataCite DOI. */
class DataCiteGetDoiActivities extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_doi_activities';
    protected const DESCRIPTION = 'Return activities for a specific DataCite DOI.';
    protected const PATH = 'dois/{id}/activities';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'DOI.'],
    ];
}
