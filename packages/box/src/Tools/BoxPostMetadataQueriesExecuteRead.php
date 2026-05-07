<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Query files/folders by metadata.
 *
 * Executes the official Box API operation post_metadata_queries_execute_read.
 */
class BoxPostMetadataQueriesExecuteRead extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_metadata_queries_execute_read';
}
