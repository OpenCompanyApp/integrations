<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Fetch a single ClinicalTrials.gov study by NCT ID.
 */
class ClinicalTrialsGovFetchStudy extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_fetch_study';
    protected const DESCRIPTION = 'Fetch a single ClinicalTrials.gov study by NCT ID in JSON, CSV, ZIP JSON, FHIR JSON, or RIS format.';
    protected const METHOD = 'fetchStudy';
    protected const DEFAULTS = ['format' => 'json', 'markupFormat' => 'markdown'];
    protected const REQUIRED = ['nctId'];
    protected const PARAMETERS = [
        'nctId' => ['type' => 'string', 'required' => true, 'description' => 'NCT identifier such as NCT00841061.'],
        'format' => ['type' => 'string', 'required' => false, 'description' => 'csv, json, json.zip, fhir.json, or ris. Defaults to json.'],
        'markupFormat' => ['type' => 'string', 'required' => false, 'description' => 'markdown or legacy for markup fields.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields, pieces, areas, or RIS tags to return where the selected format supports it.', 'items' => ['type' => 'string']],
    ];
}
