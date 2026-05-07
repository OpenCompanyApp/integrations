<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Retrieve ClinicalTrials.gov study data model metadata.
 */
class ClinicalTrialsGovMetadata extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_metadata';
    protected const DESCRIPTION = 'Retrieve the ClinicalTrials.gov study data model field tree.';
    protected const METHOD = 'metadata';
    protected const PARAMETERS = [
        'includeIndexedOnly' => ['type' => 'boolean', 'required' => false, 'description' => 'Include indexed-only fields.'],
        'includeHistoricOnly' => ['type' => 'boolean', 'required' => false, 'description' => 'Include historic-only fields.'],
    ];
}
