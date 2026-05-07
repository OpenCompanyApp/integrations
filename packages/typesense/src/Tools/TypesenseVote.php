<?php

namespace OpenCompany\Integrations\Typesense\Tools;

/**
 * Triggers a follower node to initiate the raft voting process, which triggers leader re-election..
 *
 * Generated Typesense API tool for POST /operations/vote.
 */
class TypesenseVote extends AbstractTypesenseOperationTool
{
    protected const TOOL_NAME = 'typesense_vote';
}
