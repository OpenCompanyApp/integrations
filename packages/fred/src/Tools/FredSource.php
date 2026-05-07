<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get one FRED data source.
 */
class FredSource extends AbstractFredTool
{
    protected const NAME = 'fred_source';
    protected const DESCRIPTION = 'Get metadata for one FRED data source by source_id.';
    protected const METHOD = 'source';

    public function parameters(): array
    {
        return FredParameters::source();
    }
}
