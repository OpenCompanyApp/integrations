<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Return DataCite provider DOI production statistics. */
class DataCiteProviderStats extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_provider_stats';
    protected const DESCRIPTION = 'Return DataCite providers DOI production statistics.';
    protected const PATH = 'providers/stats';
}
