<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

/**
 * Search or list ClinicalTrials.gov studies with API v2.
 */
class ClinicalTrialsGovListStudies extends AbstractClinicalTrialsGovTool
{
    protected const NAME = 'clinicaltrials_gov_list_studies';
    protected const DESCRIPTION = 'Search or list ClinicalTrials.gov studies with query.*, filter.*, postFilter.*, aggregation, fields, sort, and paging parameters.';
    protected const METHOD = 'listStudies';
    protected const DEFAULTS = ['format' => 'json', 'markupFormat' => 'markdown'];
    protected const PARAMETERS = [
        'format' => ['type' => 'string', 'required' => false, 'description' => 'csv or json. Defaults to json.'],
        'markupFormat' => ['type' => 'string', 'required' => false, 'description' => 'markdown or legacy for markup fields.'],
        'query.term' => ['type' => 'string', 'required' => false, 'description' => 'Other terms query in Essie expression syntax.'],
        'query.cond' => ['type' => 'string', 'required' => false, 'description' => 'Condition or disease query.'],
        'query.locn' => ['type' => 'string', 'required' => false, 'description' => 'Location terms query.'],
        'query.titles' => ['type' => 'string', 'required' => false, 'description' => 'Title or acronym query.'],
        'query.intr' => ['type' => 'string', 'required' => false, 'description' => 'Intervention or treatment query.'],
        'query.outc' => ['type' => 'string', 'required' => false, 'description' => 'Outcome measure query.'],
        'query.spons' => ['type' => 'string', 'required' => false, 'description' => 'Sponsor or collaborator query.'],
        'query.lead' => ['type' => 'string', 'required' => false, 'description' => 'Lead sponsor query.'],
        'query.id' => ['type' => 'string', 'required' => false, 'description' => 'Study ID query.'],
        'query.patient' => ['type' => 'string', 'required' => false, 'description' => 'Patient-focused search query.'],
        'filter.overallStatus' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Overall status filter values.', 'items' => ['type' => 'string']],
        'filter.ids' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'NCT ID filters.', 'items' => ['type' => 'string']],
        'filter.geo' => ['type' => 'string', 'required' => false, 'description' => 'Distance filter, e.g. distance(39.0,-77.1,50mi).'],
        'filter.advanced' => ['type' => 'string', 'required' => false, 'description' => 'Advanced Essie filter expression.'],
        'filter.synonyms' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Search area synonym filters.', 'items' => ['type' => 'string']],
        'postFilter.overallStatus' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Post-filter status values.', 'items' => ['type' => 'string']],
        'aggFilters' => ['type' => 'string', 'required' => false, 'description' => 'Aggregation filter expression.'],
        'geoDecay' => ['type' => 'string', 'required' => false, 'description' => 'Geo proximity scoring function.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields, pieces, areas, or @query to return.', 'items' => ['type' => 'string']],
        'sort' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Sort field/piece names with optional :asc or :desc.', 'items' => ['type' => 'string']],
        'countTotal' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to calculate totalCount on the first page.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum studies per page, coerced to at most 1000 by the API.'],
        'pageToken' => ['type' => 'string', 'required' => false, 'description' => 'nextPageToken from a previous JSON response.'],
    ];
}
