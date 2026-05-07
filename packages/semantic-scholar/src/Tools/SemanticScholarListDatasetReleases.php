<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * List available Semantic Scholar dataset releases.
 */
class SemanticScholarListDatasetReleases extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_list_dataset_releases';
    protected const DESCRIPTION = 'List available Semantic Scholar Datasets API releases.';
    protected const SERVICE_METHOD = 'datasetsGet';
    protected const PATH = 'release/';
}
