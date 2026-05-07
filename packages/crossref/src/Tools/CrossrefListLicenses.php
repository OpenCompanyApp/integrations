<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List Crossref licenses. */
class CrossrefListLicenses extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_licenses';
    protected const DESCRIPTION = 'List licenses used by registered Crossref content items.';
    protected const PATH = 'licenses';
}
