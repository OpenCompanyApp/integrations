<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Return DataCite client DOI production statistics. */
class DataCiteClientStats extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_client_stats';
    protected const DESCRIPTION = 'Return DataCite clients DOI production statistics.';
    protected const PATH = 'clients/stats';
}
