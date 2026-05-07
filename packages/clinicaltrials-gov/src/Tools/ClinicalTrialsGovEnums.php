<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Retrieve ClinicalTrials.gov enum types and values.
 */
class ClinicalTrialsGovEnums extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_enums';
    protected const DESCRIPTION = 'Retrieve ClinicalTrials.gov enum types, pieces, values, legacy values, and exceptions.';
    protected const METHOD = 'enums';
}
