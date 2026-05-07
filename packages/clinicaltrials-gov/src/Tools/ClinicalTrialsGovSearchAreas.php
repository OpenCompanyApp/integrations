<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Retrieve ClinicalTrials.gov search areas.
 */
class ClinicalTrialsGovSearchAreas extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_search_areas';
    protected const DESCRIPTION = 'Retrieve ClinicalTrials.gov search documents and search areas for building API v2 queries.';
    protected const METHOD = 'searchAreas';
}
