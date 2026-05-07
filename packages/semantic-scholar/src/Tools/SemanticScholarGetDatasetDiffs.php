<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Get incremental diff download links for a dataset.
 */
class SemanticScholarGetDatasetDiffs extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_get_dataset_diffs';
    protected const DESCRIPTION = 'Get download links for incremental diffs between two Semantic Scholar dataset releases.';
    protected const SERVICE_METHOD = 'datasetsGet';
    protected const PATH = 'diffs/{start_release_id}/to/{end_release_id}/{dataset_name}';
    protected const PATH_PARAMS = ['start_release_id', 'end_release_id', 'dataset_name'];
    protected const PARAMETERS = [
        'start_release_id' => ['type' => 'string', 'required' => true, 'description' => 'Starting release ID.'],
        'end_release_id' => ['type' => 'string', 'required' => true, 'description' => 'Ending release ID.'],
        'dataset_name' => ['type' => 'string', 'required' => true, 'description' => 'Dataset name.'],
    ];
}
