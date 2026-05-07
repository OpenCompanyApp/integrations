<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Return DataCite prefix DOI production statistics. */
class DataCitePrefixStats extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_prefix_stats';
    protected const DESCRIPTION = 'Return DataCite prefixes DOI production statistics.';
    protected const PATH = 'prefixes/stats';
}
