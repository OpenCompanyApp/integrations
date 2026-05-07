<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** List DataCite Event Data records. */
class DataCiteListEvents extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_list_events';
    protected const DESCRIPTION = 'List DataCite Event Data records.';
    protected const PATH = 'events';
    protected const PARAMETERS = [
        'doi' => ['type' => 'string', 'required' => false, 'description' => 'Filter events by DOI.'],
        'prefix' => ['type' => 'string', 'required' => false, 'description' => 'Filter events by DOI prefix.'],
        'source-id' => ['type' => 'string', 'required' => false, 'description' => 'Filter events by source.'],
        'relation-type-id' => ['type' => 'string', 'required' => false, 'description' => 'Filter events by relation type.'],
        'year-month' => ['type' => 'string', 'required' => false, 'description' => 'Filter by event year-month.'],
    ];
}
