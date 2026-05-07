<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Return official SEC EDGAR bulk archive ZIP URLs.
 */
class SecEdgarBulkArchives extends AbstractSecEdgarTool
{
    protected const NAME = 'sec_edgar_bulk_archives';
    protected const DESCRIPTION = 'Return official SEC EDGAR bulk archive ZIP URLs for submissions and company facts.';
    protected const METHOD = 'bulkArchives';
}
