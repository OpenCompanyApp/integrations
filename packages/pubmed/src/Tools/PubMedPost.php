<?php

namespace OpenCompany\Integrations\PubMed\Tools;

/**
 * Post PubMed IDs to the NCBI History server with EPost.
 */
class PubMedPost extends AbstractPubMedTool
{
    protected const NAME = 'pubmed_post';
    protected const DESCRIPTION = 'Post PubMed or other Entrez UIDs to the NCBI History server with EPost and return query_key/WebEnv values for later calls.';
    protected const UTILITY = 'epost';
    protected const METHOD = 'POST';
    protected const DEFAULTS = ['db' => 'pubmed', 'retmode' => 'json'];
    protected const REQUIRED = ['id'];
    protected const BODY_FIELDS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => ['string', 'array'], 'required' => true, 'description' => 'One UID or an array of UIDs to post.', 'items' => ['type' => 'string']],
        'retmode' => ['type' => 'string', 'required' => false, 'description' => 'Response mode. Defaults to json.'],
    ];
}
