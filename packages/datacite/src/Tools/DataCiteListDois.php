<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** List DataCite DOI metadata records. */
class DataCiteListDois extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_list_dois';
    protected const DESCRIPTION = 'List, search, filter, sort, sample, or page DataCite DOI metadata records.';
    protected const PATH = 'dois';
    protected const PARAMETERS = [
        'created' => ['type' => 'string', 'required' => false, 'description' => 'Created year filter.'],
        'registered' => ['type' => 'string', 'required' => false, 'description' => 'Registered year filter.'],
        'published' => ['type' => 'string', 'required' => false, 'description' => 'Published year filter.'],
        'provider-id' => ['type' => 'string', 'required' => false, 'description' => 'Provider ID filter.'],
        'client-id' => ['type' => 'string', 'required' => false, 'description' => 'Client/repository ID filter.'],
        'prefix' => ['type' => 'string', 'required' => false, 'description' => 'DOI prefix filter.'],
        'resource-type-id' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'resourceTypeGeneral filter.', 'items' => ['type' => 'string']],
        'random' => ['type' => 'boolean', 'required' => false, 'description' => 'Retrieve a random sample.'],
        'sample-size' => ['type' => 'integer', 'required' => false, 'description' => 'Sample size for random results.'],
        'detail' => ['type' => 'boolean', 'required' => false, 'description' => 'Include detailed DOI attributes and relationships.'],
    ];
}
