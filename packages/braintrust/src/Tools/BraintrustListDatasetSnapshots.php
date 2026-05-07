<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust dataset snapshots.
 */
class BraintrustListDatasetSnapshots extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_dataset_snapshots';
    protected const DESCRIPTION = 'List Braintrust dataset snapshots.';
    protected const PATH = '/v1/dataset_snapshot';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters and pagination.']];
}
