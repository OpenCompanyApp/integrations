<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * Get root metadata for one Census dataset.
 */
class UsCensusDatasetMetadata extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_dataset_metadata';
    protected const DESCRIPTION = 'Get root metadata for one Census API dataset path.';
    protected const METHOD = 'datasetMetadata';

    public function parameters(): array
    {
        return UsCensusParameters::dataset();
    }
}
